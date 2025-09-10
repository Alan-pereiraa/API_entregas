<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnidadeController extends Controller
{
    public function index(): JsonResponse
    {
        $unidades = Unidade::with('agencia')->get();

        return response()->json($unidades);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'telefone' => 'required|string|min:11|max:11|unique:unidades',
            'endereco' => 'required|string|min:10|max:100',
            'unidade_ativa' => 'required|boolean',
            'agencia_id' => 'required|exists:agencias,id',
        ]);

        $unidade = Unidade::create($validated);

        return response()->json($unidade, 201);
    }

    public function show($id): JsonResponse
    {
        $unidade = Unidade::with('agencia')->findOrFail($id);

        return response()->json($unidade);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $unidade = Unidade::findOrFail($id);
        $validated = $request->validate([
            'telefone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('unidades')->ignore($unidade->id)],
            'endereco' => 'sometimes|string|min:10|max:100',
            'unidade_ativa' => 'sometimes|boolean',
        ]);

        $unidade->update($validated);

        return response()->json($unidade);

    }
}
