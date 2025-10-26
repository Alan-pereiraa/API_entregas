<?php

namespace App\CQRS\Commands\Rastreamento;

class UpdateRastreamentoCommand
{
    public function __construct(
        public readonly string $id,
        public readonly bool $concluido
    ) {
    }
}
