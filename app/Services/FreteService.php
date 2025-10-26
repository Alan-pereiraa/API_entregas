<?php

namespace App\Services;

use App\Models\Encomenda;
use App\Strategies\FreteCalculatorContext;
use App\Strategies\FreteCalculator\PorPesoStrategy;
use App\Strategies\FreteCalculator\PorFaixaStrategy;
use App\Strategies\FreteCalculator\PrecoFixoStrategy;
use App\Strategies\FreteCalculator\PorDistanciaStrategy;

class FreteService
{
    private FreteCalculatorContext $context;

    public function __construct()
    {
        $this->context = new FreteCalculatorContext();
    }

    public function calcularFrete(Encomenda $encomenda): float
    {
        if (!$encomenda->relationLoaded('servico')) {
            $encomenda->load('servico');
        }

        $tipoCalculo = $encomenda->servico->tipo_calculo ?? 'por_peso';

        $strategy = match ($tipoCalculo) {
            'por_peso' => new PorPesoStrategy(),
            'por_faixa' => new PorFaixaStrategy(),
            'preco_fixo' => new PrecoFixoStrategy(),
            'por_distancia' => new PorDistanciaStrategy(),
            default => throw new \InvalidArgumentException(
                "Tipo de cálculo inválido: {$tipoCalculo}"
            ),
        };

        $this->context->setStrategy($strategy);

        return $this->context->executar($encomenda);
    }

    public function calcularFreteArredondado(Encomenda $encomenda): float
    {
        $valor = $this->calcularFrete($encomenda);

        return round($valor, 2);
    }
}
