<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EncomendaFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_new_encomenda()
    {
        $this->seed();

        $cliente_remetente = Cliente::inRandomOrder()->first(); // Pega um usuário aleatório para ser o remetente
        $cliente_destinatario = Cliente::inRandomOrder()->first(); // Pega um usuário aleatório para ser o destinatário

        $payload = [
            'peso' => 23.0,
            'cliente_remetente_id' => $cliente_remetente->id,
            'cliente_destinatario_id' => $cliente_destinatario->id,
            'servico_id' => 1,
        ];

        $response = $this->withoutMiddleware()->postJson('/api/encomenda', $payload); // Requisição sem passar pelo Middleware de autenticação de token

        $response->assertStatus(201)->assertJsonFragment($payload); // Asserção de status e conteúdo

        $this->assertDatabaseHas('encomendas', $payload); // Mesma coisa que um select procurando a encomenda criada

    }
}
