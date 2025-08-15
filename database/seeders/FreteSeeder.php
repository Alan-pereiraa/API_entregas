<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FreteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fretes')->insert([
            [
                'encomenda_id' => 1,
                'valor' => 15.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'encomenda_id' => 2,
                'valor' => 8.75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'encomenda_id' => 3,
                'valor' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
