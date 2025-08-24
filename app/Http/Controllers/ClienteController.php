<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;
use App\Models\ClienteEmpresa;
use App\Models\ClientePessoa;
use App\Models\Encomenda;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function index (Request $request): JsonResponse
    {   
        $requestType = $request->query('tipo');
        $requestType = in_array($requestType, ['pessoa', 'empresa']) ? $requestType : false;
        $data = $requestType ? Cliente::with($requestType)->where('tipo', $requestType)->get() : Cliente::all();

        $response = $data->map(function ($cliente) use ($requestType) {
             $baseArray = $cliente;

             if (!$requestType) {
                $baseArray[$cliente->tipo] = $cliente->tipo === 'pessoa' ?
                    $cliente->pessoa
                    : $cliente->empresa;
             }

            return $baseArray;
        });

        return response()->json($response);
    }

    public function show (string $id): JsonResponse
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->tipo === 'pessoa'
            ? $cliente->pessoa
            : $cliente->empresa;

        return response()->json($cliente);
    }

    public function destroy (string $id): JsonResponse 
    {
        $clienteAssociatedToEncomenda = Encomenda::where('cliente_remetente_id', $id)
            ->orWhere('cliente_destinatario_id', $id)
            ->exists();

        if ($clienteAssociatedToEncomenda) {
            return response()->json([
                'message' => 'Cliente associado a alguma encomenda!',
                'error' => 'Conflict'
            ], 409);
        }

        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return response()->json(null, 204);
    }

    public function store(Request $request): JsonResponse
    {
        $rules = [
            'tipo' => 'required|in:pessoa,empresa',
            'endereco' => 'required|string|min:10|max:50',
            'telefone' => 'required|string|min:11|max:11|unique:clientes',
            'email' => 'required|email|min:10|max:50|unique:clientes'
        ];

        if ($request->tipo === 'pessoa') {
            $rules['nome'] = 'required|string|min:10|max:100';
            $rules['cpf'] = 'required|string|min:11|max:11|unique:cliente_pessoas';
        } else {
             $rules['razao_social'] = 'required|string|min:10|max:50|unique:cliente_empresas';
             $rules['nome_fantasia'] = 'required|string|min:10|max:100|unique:cliente_empresas';
             $rules['cnpj'] = 'required|string|min:14|max:14|unique:cliente_empresas';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $cliente = Cliente::create($request->all());

        $cliente_informations = $request->all();
        $cliente_informations['cliente_id'] = $cliente->id;

        $cliente_informations = $cliente->tipo === 'pessoa' ?
            ClientePessoa::create($cliente_informations)
            : ClienteEmpresa::create($cliente_informations);

        $cliente[$cliente->tipo] = $cliente_informations;
        return response()->json($cliente);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $requestData = $request->all();
        $clientFields = ['endereco', 'telefone', 'email'];
        $clientPessoaFields = ['nome', 'cpf'];
        $clientEmpresaFields = ['razao_social', 'nome_fantasia', 'cnpj'];

        $cliente = Cliente::findOrFail($id);
        $cliente_informations_fields = [];
        $cliente_informations = [];

        $rules = [
            'tipo' => 'required|in:pessoa,empresa',
            'endereco' => 'sometimes|string|min:10|max:50',
            'telefone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('clientes')->ignore($cliente->id)],
            'email' => ['sometimes', 'email', 'min:10', 'max:50', Rule::unique('clientes')->ignore($cliente->id)]
        ];

        if ($cliente->tipo === 'pessoa') {
            $cliente_informations_fields = $clientPessoaFields;
            $cliente_informations = ClientePessoa::where('cliente_id', $cliente->id)->first();

            $rules['nome'] = ['sometimes', 'string', 'min:10', 'max:100', Rule::unique('cliente_pessoas')->ignore($cliente_informations->id)];
            $rules['cpf'] = ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('cliente_pessoas')->ignore($cliente_informations->id)];
        } else {
            $cliente_informations_fields = $clientEmpresaFields;
            $cliente_informations = ClienteEmpresa::where('cliente_id', $cliente->id)->first();

            $rules['razao_social'] = ['sometimes', 'string', 'min:10', 'max:50', Rule::unique('cliente_empresas')->ignore($cliente_informations->id)]; 
            $rules['nome_fantasia'] = ['sometimes', 'string', 'min:10', 'max:100', Rule::unique('cliente_empresas')->ignore($cliente_informations->id)];
            $rules['cnpj'] = ['sometimes', 'string', 'min:14', 'max:14', Rule::unique('cliente_empresas')->ignore($cliente_informations->id)];
        }

        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $cliente_data = $request->only($clientFields);
        $client_informations_data = $request->only($cliente_informations_fields);

        $cliente->update($cliente_data);
        $cliente_informations->update($client_informations_data);

        $cliente[$cliente->tipo] = $cliente_informations;
        return response()->json($cliente);
    }
}
