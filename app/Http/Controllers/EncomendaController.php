<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Encomenda;
use App\Models\Unidade;

class EncomendaController extends Controller
{
    public function index(): JsonResponse
    {
        $encomendas = Encomenda::with(['remetente', 'destinatario', 'servico', 'rastreamento'])->get();
        return response()->json($encomendas);
    }

    public function show(string $id): JsonResponse
    {
        $encomenda = Encomenda::with(['remetente', 'destinatario', 'servico', 'rastreamento'])
            ->findOrFail($id);
        return response()->json($encomenda);
    }
    
    public function store (Request $request): JsonResponse
    {
        $unidades = Unidade::all();
        $max_unidades = count($unidades);

        if ($max_unidades === 0) {
            return response()->json([
                'message' => 'Insira uma unidade no sistema'
            ], 500);
        }

        $validated = $request->validate([
            'peso' => [
                'required',
                'numeric',
                'min:0',
                'max:100000',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'cliente_remetente_id' => 'required|exists:clientes,id',
            'cliente_destinatario_id' => 'required|exists:clientes,id',
            'servico_id' => 'required|exists:servicos,id'
        ]);

        $encomenda = Encomenda::create($validated);
        $quantidade_unidades = rand(1, $max_unidades);
        $rastreios = [];    
        $unidades = Unidade::inRandomOrder()->take($quantidade_unidades)->get();
        foreach ($unidades as $unidade) {
            $rastreios[] = [
                'status' => 'Aguardando Encomenda', 
                'observacoes' => 'Unidade Aguardando Recebimento da Encomenda',
                'unidade_id' => $unidade->id,
                'encomenda_id' => $encomenda->id,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        $rastreios =  $encomenda->rastreamento()->createMany($rastreios);
        $encomenda['rastreios'] = $rastreios;
        
        return response()->json($encomenda);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $encomenda = Encomenda::findOrFail($id);
        $validated = $request->validate([
            'peso' => [
                'required',
                'numeric',
                'min:0',
                'max:100000',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
        ]);

        $encomenda->update($validated);
        return response()->json($encomenda);
    }

    public function destroy (string $id): JsonResponse
    {
        $encomenda = Encomenda::findOrFail($id);
        $encomenda->delete();
        return response()->json(null, 201);
    }
}
