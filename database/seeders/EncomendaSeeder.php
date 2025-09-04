<?php

namespace Database\Seeders;

use App\Models\Encomenda;
use Illuminate\Database\Seeder;


class EncomendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Encomenda::factory(10)->create();
    }
}
