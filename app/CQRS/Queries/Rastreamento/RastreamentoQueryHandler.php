<?php

namespace App\CQRS\Queries\Rastreamento;

use App\Models\Rastreamento;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RastreamentoQueryHandler
{
    public function handleGetAll(GetAllRastreamentosQuery $query): Collection
    {
        return Rastreamento::with(['unidade', 'encomenda'])->get();
    }

    public function handleGetById(GetRastreamentoByIdQuery $query): Rastreamento
    {
        return Rastreamento::with(['unidade', 'encomenda'])
            ->findOrFail($query->id);
    }

    public function handleGetByEncomenda(GetRastreamentosByEncomendaQuery $query): Collection
    {
        return Rastreamento::where('encomenda_id', $query->encomendaId)->get();
    }
}
