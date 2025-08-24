<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Agencia;

class AgenciaController extends Controller
{
    public function index(): JsonResponse
    {
        $agencias = Agencia::all();
        return response()->json($agencias);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'razao_social' => 'required|string|min:3|max:50|unique:agencias',
            'nome_fantasia' => 'required|string|min:3|max:100',
            'cnpj' => 'required|string|min:13|max:14|unique:agencias',
            'telefone' => 'required|string|min:11|max:11|unique:agencias',
            'email' => 'required|email|min:3|max:50|unique:agencias',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $agencia = Agencia::create($request->all());
        return response()->json($agencia, 201);
    }

    public function show($id): JsonResponse
    {
        $agencia = Agencia::findOrFail($id);
        return response()->json($agencia);
    }

    public function destroy(string $id): JsonResponse
    {
        $agencia = Agencia::findOrFail($id);
        $agencia->delete();
        return response()->json(null, 204);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $agencia = Agencia::findOrFail($id);

        if (!$agencia) {
            return response()->json(null, 404);
        }

        $validator = Validator::make($request->all(), [
            'razao_social' => ['sometimes', 'max:50', 'string', 'min:3' 'max:50' Rule::unique('agencias')->ignore($agencia->id)],
            'cnpj' => ['sometimes', 'string', 'min:14', 'max:14', Rule::unique('agencias')->ignore($agencia->id) ],
            'telefone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('agencias')->ignore($agencia->id)],
            'email' => ['sometimes', 'email', 'min:3', 'max:50', Rule::unique('agencias')->ignore($agencia->id)],
            'nome_fantasia' => 'sometimes|string|min:3|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $agencia->update($request->all());
        return response()->json($agencia);

    }
}
