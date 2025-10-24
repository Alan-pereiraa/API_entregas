<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Cliente;    
use App\Models\ClientePessoa;
use App\Models\ClienteEmpresa;
use App\Contracts\ClientRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class ClientRepository implements ClientRepositoryInterface 
{

    public function createClientPessoa(array $data): Cliente
    {
        return DB::transaction(function () use ($data) {
            
            $client_base = Cliente::create([
                "endereco" => $data["endereco"],
                "telefone" => $data["telefone"],
                "email" => $data["email"],
                "tipo" => $data["tipo"]
            ]);

            ClientePessoa::create([
                "nome" => $data["nome"],
                "cpf" => $data["cpf"],
                "cliente_id" => $client_base->id
            ]);

            return $client_base->fresh(['pessoa']);
        });
    }

    public function createClientEmpresa(array $data): Cliente
    {
        return DB::transaction(function () use ($data)
        {
            $client_base = Cliente::create([
                "endereco" => $data["endereco"],
                "telefone" => $data["telefone"],
                "email" => $data["email"],
                "tipo" => $data["tipo"]
            ]);

            ClienteEmpresa::create([
                'razao_social'=> $data['razao_social'],
                'nome_fantasia' => $data['nome_fantasia'],
                'cnpj' => $data['cnpj'],
                'cliente_id' => $client_base->id
            ]);

            return $client_base->fresh(['empresa']);
        });
    }

    public function update(string $id, array $data): Cliente
    {
        return DB::transaction(function () use ($data, $id){
            $client_base = Cliente::findOrFail($id);

            $client_base->update([
                'endereco'=> $data['endereco'],
                'telefone'=> $data['telefone'],
                'email'=> $data['email'],
                'tipo'=> $data['tipo'],
            ]);

            switch ($client_base->tipo) {
                case 'empresa':
                    $empresa = ClienteEmpresa::where('cliente_id', $client_base->id)->first();

                    if($empresa)
                    {
                        $empresa->update([
                            'razao_social'=> $data['razao_social'] ?? $empresa->razao_social,
                            'nome_fantasia'=> $data['nome_fantasia'] ?? $empresa->nome_fantasia,
                            'cnpj'=> $data['cnpj'] ?? $empresa->cnpj,
                        ]);
                    }
                    
                    break;
                case 'pessoa':
                    $pessoa = ClientePessoa::where('cliente_id', $client_base->id)->first();

                    if($pessoa)
                    {
                        $pessoa->update([
                            'nome'=> $data['nome'] ?? $pessoa->nome,
                            'cpf'=> $data['cpf'] ?? $pessoa->cpf,
                        ]);
                    }
                    
                    break;
                
                default:
                    throw new Exception('Tipo de cliente não aceito.');
                    break;
            }

            return $client_base->fresh();
        });
    }

    public function find(string $id)
    {
        return Cliente::find($id);
    }

    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->delete();


        return [
            'message' => 'Cliente excluído com sucesso.',
            'id' => $cliente->id
        ];
    }
}