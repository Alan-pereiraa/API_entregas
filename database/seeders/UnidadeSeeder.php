<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unidades')->insert([
            [
                'telefone' => '11987654321',
                'endereco' => 'Rua das Flores, 123',
                'unidade_ativa' => true,
                'agencia_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'telefone' => '21912345678',
                'endereco' => 'Avenida Brasil, 456',
                'unidade_ativa' => false,
                'agencia_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'telefone' => '31955554444',
                'endereco' => 'Praça Central, 789',
                'unidade_ativa' => true,
                'agencia_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
