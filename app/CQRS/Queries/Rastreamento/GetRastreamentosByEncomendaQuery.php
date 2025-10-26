<?php

namespace App\CQRS\Queries\Rastreamento;

class GetRastreamentosByEncomendaQuery
{
    public function __construct(
        public readonly string $encomendaId
    ) {
    }
}
