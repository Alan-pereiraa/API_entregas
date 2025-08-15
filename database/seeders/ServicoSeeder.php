<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('servicos')->insert([
            [
                'nome' => 'Serviço Expresso',
                'descricao' => 'Entrega em 24 horas.',
                'preco_base' => 25.50,
                'prazo_dias' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Serviço Padrão',
                'descricao' => 'Entrega em até 3 dias úteis.',
                'preco_base' => 15.00,
                'prazo_dias' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Entrega Econômica',
                'descricao' => 'Entrega de baixo custo, maior prazo.',
                'preco_base' => 8.75,
                'prazo_dias' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Entrega Internacional',
                'descricao' => 'Serviço para fora do país.',
                'preco_base' => 99.99,
                'prazo_dias' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Entrega Agendada',
                'descricao' => 'Entrega com data e hora marcadas.',
                'preco_base' => 35.00,
                'prazo_dias' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
