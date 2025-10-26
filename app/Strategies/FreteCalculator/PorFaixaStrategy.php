<?php

namespace App\Strategies\FreteCalculator;

use App\Models\Encomenda;

class PorFaixaStrategy implements FreteCalculatorInterface
{
    private const FAIXAS = [
        5 => 25.00,
        10 => 35.00,
        20 => 50.00,
        50 => 80.00,
    ];

    private const VALOR_ACIMA_FAIXA = 100.00;

    private const TAXA_ADICIONAL = 3.00;

    public function calcular(Encomenda $encomenda): float
    {
        $peso = $encomenda->peso;
        $precoBase = $encomenda->servico->preco_base;

        foreach (self::FAIXAS as $pesoMaximo => $valor) {
            if ($peso <= $pesoMaximo) {
                return max($valor, $precoBase);
            }
        }

        $maiorFaixa = max(array_keys(self::FAIXAS));
        $pesoExcedente = $peso - $maiorFaixa;
        $valorFrete = self::VALOR_ACIMA_FAIXA + ($pesoExcedente * self::TAXA_ADICIONAL);

        return max($valorFrete, $precoBase);
    }
}
