<?php

namespace App\CQRS\Queries\Rastreamento;

class GetRastreamentoByIdQuery
{
    public function __construct(
        public readonly string $id
    ) {
    }
}
