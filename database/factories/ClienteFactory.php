<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{

    protected $model = Cliente::class;

    public function definition(): array
    {
        return [
            'endereco' => $this->faker->address(),
            'telefone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }

    public function empresa(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'empresa'
        ]);
    }

    public function pessoa(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'pessoa'
        ]);
    }
}
