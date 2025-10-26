<?php

namespace App\Strategies\FreteCalculator;

use App\Models\Encomenda;

class PrecoFixoStrategy implements FreteCalculatorInterface
{
    public function calcular(Encomenda $encomenda): float
    {
        return $encomenda->servico->preco_base;
    }
}
