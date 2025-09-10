<?php

namespace Database\Seeders;

use App\Models\Funcionario;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    public function run(): void
    {
        // Criar 10 funcionários aleatórios
        Funcionario::factory(10)->create();
    }
}
