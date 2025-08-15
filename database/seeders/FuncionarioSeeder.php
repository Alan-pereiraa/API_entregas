<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('funcionarios')->insert([
            [
                'cpf' => '12345678901',
                'nome' => 'João Silva',
                'email' => 'joao.silva@example.com',
                'endereco' => 'Rua A, 123',
                'telefone' => '11987654321',
                'unidade_id' => 1,
                'senha' => Hash::make('123456'), // senha criptografada
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '23456789012',
                'nome' => 'Maria Oliveira',
                'email' => 'maria.oliveira@example.com',
                'endereco' => 'Avenida B, 456',
                'telefone' => '21912345678',
                'unidade_id' => 2,
                'senha' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpf' => '34567890123',
                'nome' => 'Carlos Pereira',
                'email' => 'carlos.pereira@example.com',
                'endereco' => 'Praça C, 789',
                'telefone' => '31955554444',
                'unidade_id' => 3,
                'senha' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
