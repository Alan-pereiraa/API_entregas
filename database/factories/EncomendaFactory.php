<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Frete;
use App\Models\Rastreamento;
use App\Models\Servico;
use App\Models\Unidade;
use Illuminate\Database\Eloquent\Factories\Factory;

class EncomendaFactory extends Factory
{
    protected $model = Encomenda::class;
    public function definition(): array
    {
        $remetente = Cliente::inRandomOrder()->first() ?? Cliente::factory()->create();
        $destinatario = Cliente::where('id', '!=', $remetente->id)->inRandomOrder()->first() ?? Cliente::factory()->create();
        $servico = Servico::inRandomOrder()->first() ?? Servico::factory()->create();

        return [
            'peso' => $this->faker->randomFloat(2, 0.1, 100),
            'cliente_remetente_id' => $remetente->id,
            'cliente_destinatario_id' => $destinatario->id,
            'servico_id' => $servico->id,
        ];
    }

    public function configure()
    {
        
        return $this->afterCreating(function (Encomenda $encomenda) {
            $servico = $encomenda->servico; // pega o serviço associado à encomenda
    
            // regra de cálculo do frete
           $valor = $servico->preco_base + ($servico->preco_base * 0.05 * $encomenda->peso);

            $encomenda->frete()->create([
                'encomenda_id' => $encomenda->id,
                'valor' => $valor,
            ]);

            $statusOptions = ['em_trânsito', 'em_andamento', 'cancelada', 'entregue'];

            // Pega 3 unidades aleatórias do banco
            $unidades = Unidade::inRandomOrder()->take(3)->get();

            // Se não tiver unidades suficientes, cria as que faltam
            if ($unidades->count() < 3) {
                $faltam = 3 - $unidades->count();
                $unidades = $unidades->concat(Unidade::factory($faltam)->create());
            }

            // Cria um rastreamento para cada unidade
            foreach ($unidades as $key => $unidade) {
                $encomenda->rastreamento()->create([
                    'status' => $this->faker->randomElement($statusOptions),
                    'observacoes' => $this->faker->sentence(),
                    'concluido' => $key === 0, // só a primeira unidade marcada como concluída
                    'encomenda_id' => $encomenda->id,
                    'unidade_id' => $unidade->id,
                ]);
            }
        });
    }
}
