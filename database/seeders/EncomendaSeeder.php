<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EncomendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('encomendas')->insert([
            [
                'data_hora_postagem' => now(),
                'peso' => 2.50,
                'cliente_remetente_id' => 1,
                'cliente_destinatario_id' => 2,
                'servico_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_hora_postagem' => now()->subDays(1),
                'peso' => 1.20,
                'cliente_remetente_id' => 2,
                'cliente_destinatario_id' => 3,
                'servico_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_hora_postagem' => now()->subHours(5),
                'peso' => 3.75,
                'cliente_remetente_id' => 3,
                'cliente_destinatario_id' => 1,
                'servico_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
