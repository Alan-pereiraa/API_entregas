<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Agencia;
use Faker\Provider\pt_BR\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agencia>
 */
class AgenciaFactory extends Factory
{

    protected $model = Agencia::class;

    public function definition(): array
    {
        $faker = $this->faker;
        $faker->addProvider(new Company($faker));
        
        return [
            'razao_social' => $this->faker->unique()->company(),
            'nome_fantasia' => $this->faker->company(),
            'cnpj' => $this->faker->unique()->cnpj(false),
            'telefone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
