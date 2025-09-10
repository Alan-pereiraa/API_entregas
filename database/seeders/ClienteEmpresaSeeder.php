<?php

namespace Database\Seeders;

use App\Models\ClienteEmpresa;
use Illuminate\Database\Seeder;

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
