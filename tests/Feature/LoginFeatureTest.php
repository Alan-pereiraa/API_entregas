<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginFeatureTest extends TestCase
{
    use RefreshDatabase;

    // Teste de login do usuário
    public function test_login_user ()
    {
        $this->seed();

        $user_database = User::inRandomOrder()->first(); // Pega um usuário aleatório do BD

        $response = $this->postJson('/api/login', [
            'email' => $user_database->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200)->assertJsonFragment([
            $user_database->email
        ]);
    }

    // Test que verifica o registro de novo usuário
    public function test_register_new_user ()
    {
        $new_user = User::factory()->make(); // Cria novo usuário

        $response = $this->postJson('/api/register', [
            'name' => $new_user->name,
            'email' => $new_user->email,
            'password' => $new_user->password,
        ]);

        $response->assertStatus(201)->assertJsonFragment([
            $new_user->name
        ]);
    }
}