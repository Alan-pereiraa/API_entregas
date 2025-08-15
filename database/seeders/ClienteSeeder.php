<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            [
                'endereco' => 'Rua A, 123',
                'telefone' => '11987654321',
                'email' => 'cliente1@exemplo.com',
                'tipo' => 'pessoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'endereco' => 'Avenida B, 456',
                'telefone' => '21912345678',
                'email' => 'cliente2@exemplo.com',
                'tipo' => 'empresa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'endereco' => 'Rua C, 789',
                'telefone' => '31955554444',
                'email' => 'cliente3@exemplo.com',
                'tipo' => 'pessoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'endereco' => 'Praça D, 101',
                'telefone' => '41977778888',
                'email' => 'cliente4@exemplo.com',
                'tipo' => 'empresa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'endereco' => 'Travessa E, 202',
                'telefone' => '51966665555',
                'email' => 'cliente5@exemplo.com',
                'tipo' => 'pessoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'endereco' => 'Estrada F, 303',
                'telefone' => '61911112222',
                'email' => 'cliente6@exemplo.com',
                'tipo' => 'empresa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'endereco' => 'Alameda G, 404',
                'telefone' => '71933334444',
                'email' => 'cliente7@exemplo.com',
                'tipo' => 'pessoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'endereco' => 'Jardim H, 505',
                'telefone' => '81922223333',
                'email' => 'cliente8@exemplo.com',
                'tipo' => 'empresa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'endereco' => 'Beco I, 606',
                'telefone' => '91955556666',
                'email' => 'cliente9@exemplo.com',
                'tipo' => 'pessoa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'endereco' => 'Condomínio J, 707',
                'telefone' => '99988887777',
                'email' => 'cliente10@exemplo.com',
                'tipo' => 'empresa',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ]);
    }
}
