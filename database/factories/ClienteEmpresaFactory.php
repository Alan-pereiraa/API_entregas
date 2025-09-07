<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Cliente;
use App\Models\ClienteEmpresa;
use Faker\Provider\pt_BR\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClienteEmpresa>
 */
class ClienteEmpresaFactory extends Factory
{

    protected $model = ClienteEmpresa::class;

    public function definition(): array
    {
        $cliente = Cliente::factory()->empresa()->create();
        $faker = $this->faker;
        $faker->addProvider(new Company($faker));

        return [
            'cliente_id' => $cliente->id, // FK,
            'razao_social' => $this->faker->unique()->company(),
            'nome_fantasia' => $this->faker->company(),
            'cnpj' => $this->faker->cnpj(false),
        ];
    }
}
