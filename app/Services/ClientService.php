<?php

namespace App\Services;
use App\Models\Encomenda;
use App\Factories\ClientFactory;
use App\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Cliente;
use Exception;

class ClientService 
{
    protected $factory;

    public function __construct(ClientFactory $factory, ClientRepositoryInterface $repository)
    {
        $this->factory = $factory;
        $this->repository = $repository;
    }

    public function createClient(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $client = $this->factory->create($data);

                return $client;
            });
        } catch (\Exception $e) {
            throw new Exception('Falha ao cadastrar cliente. Detalhes: ' . $e->getMessage());
        }
    }

    public function listClients(?string $tipo = null)
    {
        $query = Cliente::query();

        if($tipo && in_array($tipo, ['pessoa','empresa'])) 
        {
            $query->with($tipo)->where('tipo', $tipo);
        } else {
            $query->with(['pessoa','empresa']);
        }

        return $query->get();
    }

    public function listClientById(string $id)
    {
        $client = Cliente::find($id);

        if (!$client) {
            throw new Exception("Cliente não encontrado com ID {$id}");
        }

        $client->load($client->tipo);

        return $client;
    }

    public function updatedClientById(string $id, array $data)
    {
        try {
            $client = $this->repository->find($id);

            if(!$client)
            {
                throw new Exception("Cliente não encontrado.");
            }

            
            $client_update = $this->repository->update($id, $data);

            return $client_update;
        } catch (\Exception $e) {
            throw new Exception("Não foi possivel atualizar o cliente.");
        }
    }

    public function deleteClientById(string $id)
    {
        try {

            $clienteAssociatedToEncomenda = Encomenda::where('cliente_remetente_id', $id)
                ->orWhere('cliente_destinatario_id', $id)
                ->exists();

            if ($clienteAssociatedToEncomenda) {
                throw new Exception('Cliente associado a alguma encomenda!');
            }

            $response = $this->repository->destroy($id);

            return $response;
        } catch (\Exception $erro) {
            if ($erro->getMessage() === 'Cliente associado a alguma encomenda!') {
                throw $erro;
            }
            
            throw new Exception('Não foi possível deletar o cliente: ' . $erro->getMessage());
        }
    }

}