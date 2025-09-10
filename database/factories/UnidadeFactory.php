<?php

namespace Database\Factories;

use App\Models\Agencia;
use App\Models\Unidade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unidade>
 */
class UnidadeFactory extends Factory
{
    protected $model = Unidade::class;

    public function definition(): array
    {
        return [
            'telefone' => $this->faker->unique()->phoneNumber(),
            'endereco' => $this->faker->address(),
            'unidade_ativa' => $this->faker->boolean(),
            'agencia_id' => Agencia::factory(),
        ];
    }
}
