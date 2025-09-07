<?php

namespace Database\Seeders;

use App\Models\ClientePessoa;
use Illuminate\Database\Seeder;


class ClientePessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientePessoa::factory(10)->create();
    }
}
