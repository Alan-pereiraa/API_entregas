<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RastreamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rastreamentos')->insert([
            [
                'status' => 'Em trânsito',
                'data_hora' => now(),
                'observacoes' => 'Saiu do centro de distribuição',
                'encomenda_id' => 1,
                'unidade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Entregue',
                'data_hora' => now()->addHours(2),
                'observacoes' => 'Entregue ao destinatário',
                'encomenda_id' => 2,
                'unidade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Aguardando retirada',
                'data_hora' => now()->addHours(1),
                'observacoes' => 'Disponível para retirada no balcão',
                'encomenda_id' => 3,
                'unidade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
