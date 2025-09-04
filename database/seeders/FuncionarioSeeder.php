<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Funcionario;
use App\Models\User;
use App\Models\Unidade;
use Illuminate\Support\Facades\Hash;

class FuncionarioSeeder extends Seeder
{
    public function run(): void
    {
        // Criar 10 funcionários aleatórios
        Funcionario::factory(10)->create();
    }
}
