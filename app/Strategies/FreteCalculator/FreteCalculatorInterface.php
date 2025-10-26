<?php

namespace App\Strategies\FreteCalculator;

use App\Models\Encomenda;

interface FreteCalculatorInterface
{
    public function calcular(Encomenda $encomenda): float;
}
