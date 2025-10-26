<?php

namespace App\Strategies\FreteCalculator;

use App\Models\Encomenda;

class PorDistanciaStrategy implements FreteCalculatorInterface
{
    private const TAXA_POR_KM = 0.50;

    private const TAXA_PESO = 1.50;

    private const DISTANCIA_MINIMA = 10;

    public function calcular(Encomenda $encomenda): float
    {
        $precoBase = $encomenda->servico->preco_base;
        $peso = $encomenda->peso;

        $distancia = $this->calcularDistancia($encomenda);

        $valorFrete = $precoBase
            + ($distancia * self::TAXA_POR_KM)
            + ($peso * self::TAXA_PESO);

        return max($valorFrete, $precoBase);
    }

    private function calcularDistancia(Encomenda $encomenda): float
    {
        $seed = $encomenda->cliente_remetente_id + $encomenda->cliente_destinatario_id;

        $distanciaSimulada = self::DISTANCIA_MINIMA + (($seed * 17) % 490);

        return (float) $distanciaSimulada;
    }
}
