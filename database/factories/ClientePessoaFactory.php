<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;
use App\Models\ClientePessoa;
use Faker\Provider\pt_BR\Person;


class ClientePessoaFactory extends Factory
{

    protected $model = ClientePessoa::class;

    public function definition(): array
    {

        $faker = $this->faker;
        $faker->addProvider(new Person($faker));

        return [
            'nome' => $this->faker->name(),
            'cpf' => $this->faker->unique()->cpf(false),
            'cliente_id' => Cliente::factory()->pessoa()->create()->id
        ];
    }
}
