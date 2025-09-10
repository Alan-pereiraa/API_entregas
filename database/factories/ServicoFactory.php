<?php

namespace Database\Factories;

use App\Models\Servico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servico>
 */
class ServicoFactory extends Factory
{
    protected $model = Servico::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->company(),
            'descricao' => $this->faker->sentence(),
            'preco_base' => $this->faker->randomFloat(2, 1, 1000),
            'prazo_dias' => $this->faker->numberBetween(1, 100),
        ];
    }
}
