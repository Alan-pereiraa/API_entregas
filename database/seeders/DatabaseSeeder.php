<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chama outros seeders
        $this->call([
            ServicoSeeder::class,
            ClientePessoaSeeder::class,
            ClienteEmpresaSeeder::class,
            AgenciaSeeder::class,
            UnidadeSeeder::class,
            FuncionarioSeeder::class,
            EncomendaSeeder::class,
            UserSeeder::class
        ]);
    }
}
