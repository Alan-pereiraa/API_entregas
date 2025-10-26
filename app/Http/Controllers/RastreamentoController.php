<?php

namespace App\Http\Controllers;

use App\CQRS\Commands\Rastreamento\UpdateRastreamentoCommand;
use App\CQRS\Commands\Rastreamento\UpdateRastreamentoHandler;
use App\CQRS\Queries\Rastreamento\GetAllRastreamentosQuery;
use App\CQRS\Queries\Rastreamento\GetRastreamentoByIdQuery;
use App\CQRS\Queries\Rastreamento\GetRastreamentosByEncomendaQuery;
use App\CQRS\Queries\Rastreamento\RastreamentoQueryHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RastreamentoController extends Controller
{
    public function __construct(
        private readonly UpdateRastreamentoHandler $commandHandler,
        private readonly RastreamentoQueryHandler $queryHandler
    ) {
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'concluido' => 'required|boolean',
        ]);

        $command = new UpdateRastreamentoCommand(
            id: $id,
            concluido: $validated['concluido']
        );

        $rastreio = $this->commandHandler->handle($command);

        return response()->json($rastreio, 201);
    }

    public function index(): JsonResponse
    {
        $query = new GetAllRastreamentosQuery();
        $rastreios = $this->queryHandler->handleGetAll($query);

        return response()->json($rastreios);
    }

    public function show($id): JsonResponse
    {
        $query = new GetRastreamentoByIdQuery(id: $id);
        $rastreio = $this->queryHandler->handleGetById($query);

        return response()->json($rastreio);
    }

    public function showRastreamentosRelatedToEncomenda(string $id_encomenda): JsonResponse
    {
        $query = new GetRastreamentosByEncomendaQuery(encomendaId: $id_encomenda);
        $rastreios = $this->queryHandler->handleGetByEncomenda($query);

        return response()->json($rastreios);
    }
}
