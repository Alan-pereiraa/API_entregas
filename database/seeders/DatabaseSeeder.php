<?php

namespace Database\Seeders;

use App\Models\User;
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
            ClienteSeeder::class,
            ClientePessoaSeeder::class,
            ClienteEmpresaSeeder::class,
            AgenciaSeeder::class,
            UnidadeSeeder::class,
            FuncionarioSeeder::class,
            EncomendaSeeder::class,
            RastreamentoSeeder::class,
            FreteSeeder::class
        ]);

        // Cria usuários de teste
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Para criar 10 usuários aleatórios, descomente:
        // User::factory(10)->create();
    }
}
