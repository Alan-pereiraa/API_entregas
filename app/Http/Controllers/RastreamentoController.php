<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Rastreamento;

class RastreamentoController extends Controller
{
    public function update (Request $request, string $id): JsonResponse
    {
        $rastreio = Rastreamento::findOrFail($id);
        $validated = $request->validate([
            'concluido' => 'required|boolean'
        ]);

        $rastreio->update([
            'concluido' => $validated['concluido']
        ]);

        return response()->json($rastreio, 201);
    }

    public function index (): JsonResponse
    {
        $rastreios = Rastreamento::with(['unidade', 'encomenda'])->get();
        return response()->json($rastreios);
    }

    public function show ($id): JsonResponse
    {
        $rastreio = Rastreamento::with(['unidade', 'encomenda'])->findOrFail($id);
        return response()->json($rastreio);
    }
    
    public function showRastreamentosRelatedToEncomenda (string $id_encomenda): JsonResponse
    {
        $rastreios = Rastreamento::where('encomenda_id', $id_encomenda)->get();
        return response()->json($rastreios);
    }
}
