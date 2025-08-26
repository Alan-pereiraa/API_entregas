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
                'observacoes' => 'Saiu do centro de distribuição',
                'encomenda_id' => 1,
                'unidade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Entregue',
                'observacoes' => 'Entregue ao destinatário',
                'encomenda_id' => 2,
                'unidade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Aguardando retirada',
                'observacoes' => 'Disponível para retirada no balcão',
                'encomenda_id' => 3,
                'unidade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
