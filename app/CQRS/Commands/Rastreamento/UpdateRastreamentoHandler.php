<?php

namespace App\CQRS\Commands\Rastreamento;

use App\Models\Rastreamento;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateRastreamentoHandler
{
    public function handle(UpdateRastreamentoCommand $command): Rastreamento
    {
        $rastreamento = Rastreamento::findOrFail($command->id);

        $status = $this->determinarStatus($command->concluido);

        $rastreamento->update([
            'concluido' => $command->concluido,
            'status' => $status,
        ]);

        return $rastreamento->fresh();
    }

    private function determinarStatus(bool $concluido): string
    {
        return $concluido
            ? 'Encomenda Entregue'
            : 'Aguardando Encomenda';
    }
}
