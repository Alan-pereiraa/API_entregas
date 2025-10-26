<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteEmpresa;
use App\Models\ClientePessoa;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Services\ClientService;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Exception;

class ClienteController extends Controller
{
    protected $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $clients = $this->service->listClients();

        return response()->json($clients);
    }

    public function show(string $id): JsonResponse
    {
       $client = $this->service->listClientById($id);

        return response()->json($client);
    }

    public function destroy(string $id): JsonResponse
    {
        try {

            $result = $this->service->deleteClientById($id);
    
            return response()->json($result, 200);
        } catch (Expection $erro) {
            return response()->json(["error"=> $erro->getMessage()],500);
        }
    }

    public function store(StoreClientRequest $request): JsonResponse
    {

        try {
            $validated = $request->validated();

            $client = $this->service->createClient($validated);

            return response()->json([
                'message' => 'Cliente criado com sucesso.',
                'data' => $client
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'erro' => $e->getMessage(),
                'message' => 'Ocorreu um erro ao criar o cliente.'
            ], 500);
        }
    }

    public function update(UpdateClientRequest $request, string $id): JsonResponse
    {
       try {
            $validated = $request->validated();

            $client = $this->service->updatedClientById($id, $validated);

            return response()->json([
                'message' => 'Cliente atualizado com sucesso.',
                'data' => $client
            ], 200);
       } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
       }
    }
}
