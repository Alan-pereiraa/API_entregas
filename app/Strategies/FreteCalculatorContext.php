<?php

namespace App\Strategies;

use App\Models\Encomenda;
use App\Strategies\FreteCalculator\FreteCalculatorInterface;

class FreteCalculatorContext
{
    private FreteCalculatorInterface $strategy;

    public function setStrategy(FreteCalculatorInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function executar(Encomenda $encomenda): float
    {
        if (!isset($this->strategy)) {
            throw new \RuntimeException('Nenhuma estratégia de cálculo foi definida.');
        }

        return $this->strategy->calcular($encomenda);
    }
}
