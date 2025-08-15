<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agencias')->insert([
            'razao_social' => 'Agência XPTO Ltda',
            'nome_fantasia' => 'Agência XPTO',
            'cnpj' => '12345678000199',
            'telefone' => '11987654321',
            'email' => 'contato@xpto.com.br',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
