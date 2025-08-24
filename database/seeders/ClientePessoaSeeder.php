<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientePessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cliente_pessoas')->insert([
            [
                'nome' => 'João Silva',
                'cpf' => '11122233344',
                'cliente_id' => 1
            ],
            [
                'nome' => 'Maria Oliveira',
                'cpf' => '55566677788',
                'cliente_id' => 2
            ],
            [
                'nome' => 'Pedro Santos',
                'cpf' => '99988877766',
                'cliente_id' => 3
            ],
            [
                'nome' => 'Ana Costa',
                'cpf' => '44455566677',
                'cliente_id' => 4
            ],
            [
                'nome' => 'Luiz Pereira',
                'cpf' => '22233344455',
                'cliente_id' => 5
            ]
        ]);
    }
}
