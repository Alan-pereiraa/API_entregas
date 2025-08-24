<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cliente_empresas')->insert([
                        [
                'razao_social' => 'Comércio Digital Ltda.',
                'nome_fantasia' => 'CDL Marketing',
                'cnpj' => '12345678000100',
                'cliente_id' => 6,
            ],
            [
                'razao_social' => 'Global Logística S.A.',
                'nome_fantasia' => 'Global Log',
                'cnpj' => '23456789000111',
                'cliente_id' => 7,
            ],
            [
                'razao_social' => 'Serviços de Tecnologia e Inovação',
                'nome_fantasia' => 'STI Tech',
                'cnpj' => '34567890000122',
                'cliente_id' => 8,
            ],
            [
                'razao_social' => 'Indústria e Comércio Fênix',
                'nome_fantasia' => 'Fênix I.C.',
                'cnpj' => '45678901000133',
                'cliente_id' => 9,
            ],
            [
                'razao_social' => 'Soluções Integradas Ltda.',
                'nome_fantasia' => 'Soluções Integradas',
                'cnpj' => '56789012000144',
                'cliente_id' => 10,
            ]
        ]);
    }
}
