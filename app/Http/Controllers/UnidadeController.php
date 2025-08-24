<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Unidade;
use Illuminate\Validation\Rule;


class UnidadeController extends Controller
{
    public function index(): JsonResponse
    {
        $unidades = Unidade::all();
        return response()->json($unidades);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'telefone' => 'required|string|min:11|max:11|unique:unidades',
            'endereco' => 'required|string|min:10|max:100',
            'unidade_ativa' => 'required|boolean',
            'agencia_id' => 'required|exists:unidades,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $unidade = Unidade::create($request->all());
        return response()->json($unidade, 201);
    }

    public function show($id): JsonResponse
    {
        $unidade = Unidade::findOrFail($id);
        return response()->json($unidade);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $unidade = Unidade::findOrFail($id);
        $data = $request->except(['agencia_id']);

        if (!$unidade) {
            return response()->json(null, 404);
        }

        $validator = Validator::make($data, [
            'telefone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('unidades')->ignore($unidade->id)],
            'endereco' => 'sometimes|string|min:10|max:100',
            'unidade_ativa' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $unidade->update($data);
        return response()->json($unidade);

    }
}
