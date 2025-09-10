<?php

namespace Database\Factories;

use App\Models\Funcionario;
use App\Models\Unidade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcionario>
 */
class FuncionarioFactory extends Factory
{
    protected $model = Funcionario::class;

    public function definition(): array
    {
        return [
            'cpf' => $this->faker->unique->cpf(false),
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'endereco' => $this->faker->address(),
            'telefone' => $this->faker->unique()->phoneNumber(),
            'unidade_id' => Unidade::factory(),
        ];
    }
}
