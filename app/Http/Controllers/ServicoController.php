<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Servico;
use Illuminate\Validation\Rule;

class ServicoController extends Controller
{
    public function index(): JsonResponse
    {
        $servicos = Servico::all();
        return response()->json($servicos);
    }

    public function show(string $id): JsonResponse
    {
        $servico = Servico::findOrFail($id);
        return response()->json($servico);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nome' => 'required|string|min:10|max:100',
            'descricao' => 'sometimes|string|min:10|max:100',
            'preco_base' => [
                'required',
                'numeric',
                'min:0',
                'max:100000',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'prazo_dias' => 'required|integer|min:1|max:100' 
        ]);

        $servico = Servico::create($validated);
        return response()->json($servico, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $servico = Servico::findOrFail($id);;
        $validated = $request->validate([
            'nome' => 'sometimes|string|min:10|max:100',
            'descricao' => 'sometimes|string|min:10|max:100',
            'preco_base' => [
                'sometimes',
                'numeric',
                'min:0',
                'max:100000',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'prazo_dias' => 'sometimes|integer|min:1|max:100' 
        ]);

        $servico->update($validated);
        return response()->json($servico, 201);
    }

    public function destroy (string $id): JsonResponse
    {
        $servico = Servico::findOrFail($id);
        
        if ($servico->encomenda()->exists()) {
            return response()->json([
                'message' => "Esse Serviço está associado a uma encomenda"
            ], 422);
        }

        $servico->delete();
        return response()->json(null, 200);
    }
}
