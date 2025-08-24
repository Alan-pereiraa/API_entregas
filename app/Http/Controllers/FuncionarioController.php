<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Funcionario;
use Illuminate\Validation\Rule;

class FuncionarioController extends Controller
{
    public function index(): JsonResponse
    {
        $funcionarios = Funcionario::all();
        return response()->json($funcionarios);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'cpf' => 'required|string|min:11|max:11|unique:funcionarios',
            'nome' => 'required|string|min:10|max:50',
            'email' => 'required|email|min:10|max:50|unique:funcionarios',
            'endereco' => 'required|string|min:10|max:100',
            'telefone' => 'required|string|min:11|max:11|unique:funcionarios',
            'unidade_id' => 'required|exists:unidades,id',
            'senha' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $funcionario = Funcionario::create($request->all());
        return response()->json($funcionario, 201);
    }

    public function show($id): JsonResponse
    {
        $funcionario = Funcionario::findOrFail($id);
        return response()->json($funcionario);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $funcionario = Funcionario::findOrFail($id);

        if (!$funcionario) {
            return response()->json(null, 404);
        }

        $validator = Validator::make($request->all(), [
            'cpf' =>  ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('funcionarios')->ignore($funcionario->id)], 
            'telefone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('funcionarios')->ignore($funcionario->id)],
            'email' => ['sometimes', 'email', 'min:10', 'max:50', Rule::unique('funcionarios')->ignore($funcionario->id)],
            'nome' => 'sometimes|string|min:10|max:50',
            'endereco' => 'sometimes|string|min:10|max:100',
            'unidade_id' => 'sometimes|exists:unidades,id',
            'senha' => 'sometimes|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $funcionario->update($request->all());
        return response()->json($funcionario);
    }

    public function destroy (string $id): JsonResponse
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return response()->json(null, 204);

    }
}
