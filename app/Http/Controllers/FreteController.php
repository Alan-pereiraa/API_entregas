<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\Frete;
use App\Services\FreteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FreteController extends Controller
{
    public function index(): JsonResponse
    {
        $fretes = Frete::all();

        return response()->json($fretes);
    }

    public function show(string $id): JsonResponse
    {
        $frete = Frete::findOrFail($id);

        return response()->json($frete);
    }

    public function destroy($id): JsonResponse
    {
        $frete = Frete::findOrFail($id);
        $frete->delete();

        return response()->json(null, 204);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'encomenda_id' => 'required|unique:fretes|exists:encomendas,id',
            'valor' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100000',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
        ]);

        if (!isset($validated['valor']) || $validated['valor'] === null) {
            $encomenda = Encomenda::findOrFail($validated['encomenda_id']);
            $freteService = new FreteService();
            $validated['valor'] = $freteService->calcularFreteArredondado($encomenda);
        }

        $frete = Frete::create($validated);

        return response()->json([
            'frete' => $frete,
            'calculado_automaticamente' => !$request->has('valor'),
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $frete = Frete::findOrFail($id);

        $validated = $request->validate([
            'valor' => [
                'required',
                'numeric',
                'min:0',
                'max:100000',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
        ]);

        $frete->update($validated);

        return response()->json($frete);
    }
}
