<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Encomenda;
use App\Models\Servico;
use App\Models\Cliente;

class EncomendaTest extends TestCase
{
    use RefreshDatabase;

    public function test_define_is_correct_data_prevista_entrega()
    {
        // Popular o banco de teste
        $this->seed(); // Executa todos os seeders

        // Pegar um serviço e dois clientes existentes
        $servico = Servico::first();
        $clienteRemetente = Cliente::first();
        $clienteDestinatario = Cliente::skip(1)->first(); // pega o segundo cliente

        // Criar a encomenda usando IDs existentes
        $encomenda = Encomenda::create([
            'servico_id' => $servico->id,
            'cliente_remetente_id' => $clienteRemetente->id,
            'cliente_destinatario_id' => $clienteDestinatario->id,
            'peso' => 2.5,
        ]);

        // Calcular data prevista
        $data_prevista_entrega = $encomenda->dataPrevistaEntrega()->toDateString();

        // Verificar se está correto
        $this->assertEquals(
            $encomenda->created_at->copy()->addDays($servico->prazo_dias)->toDateString(),
            $data_prevista_entrega
        );
    }

    // Verfica se a encomenda é criada sem um cliente destintário
    public function test_created_encomenda_isNull_cliente_destino ()
    {
        $this->expectException(\Illuminate\Database\QueryException::class); // Lança um erro "QueryException" no caso de erro
        Encomenda::create([
            'servico_id'=> 1,
            // 'cliente_remetente_id' => ,
            'cliente_destinatario_id' => 2,
            'peso' => 2.0
        ]);
    }

    // Verifica se o serviço é associado corretamente a encomenda
    public function test_associates_service_encomenda()
    {
        $this->seed();

        $servico = Servico::first();
        $encomenda = Encomenda::create([
            'servico_id' => $servico->id,
            'cliente_remetente_id' => 1,
            'cliente_destinatario_id' => 2,
            'peso' => 3.0
        ]);

        $this->assertEquals($servico->id, $encomenda->servico->id);
    }
}
