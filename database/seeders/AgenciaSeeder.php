<?php

namespace Database\Seeders;

use App\Models\Agencia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgenciaSeeder extends Seeder
{
    public function run(): void
    {
        Agencia::factory(10)->create();
    }
}
