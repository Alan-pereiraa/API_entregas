<?php

namespace App\Strategies\FreteCalculator;

use App\Models\Encomenda;

class PorPesoStrategy implements FreteCalculatorInterface
{
    private const TAXA_POR_KG = 2.50;

    public function calcular(Encomenda $encomenda): float
    {
        $precoBase = $encomenda->servico->preco_base;
        $peso = $encomenda->peso;

        $valorFrete = $precoBase + ($peso * self::TAXA_POR_KG);

        return max($valorFrete, $precoBase);
    }
}
