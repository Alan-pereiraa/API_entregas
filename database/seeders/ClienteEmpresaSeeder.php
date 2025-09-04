<?php

namespace Database\Seeders;

use App\Models\ClienteEmpresa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClienteEmpresa::factory(10)->create();
    }
}
