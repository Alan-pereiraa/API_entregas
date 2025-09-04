<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Validation\Rule;

class FuncionarioController extends Controller
{
    public function index(): JsonResponse
    {
        $funcionarios = Funcionario::with('unidade')->get();
        return response()->json($funcionarios);
    }

    public function show($id): JsonResponse
    {
        $funcionario = Funcionario::with('unidade')->findOrFail($id);
        return response()->json($funcionario);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate( [
            'cpf' => 'required|string|min:11|max:11|unique:funcionarios',
            'nome' => 'required|string|min:10|max:50',
            'email' => 'required|email|min:10|max:50|unique:funcionarios',
            'endereco' => 'required|string|min:10|max:100',
            'telefone' => 'required|string|min:11|max:11|unique:funcionarios',
            'unidade_id' => 'required|exists:unidades,id',
            'password' => 'required|string|min:6'
        ]);

        $funcionario = Funcionario::create([]);
        return response()->json($funcionario, 201);
    }


    public function update(Request $request, string $id): JsonResponse
    {
        $funcionario = Funcionario::findOrFail($id);
        $validated = $request->validate([
            'cpf' =>  ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('funcionarios')->ignore($funcionario->id)], 
            'telefone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('funcionarios')->ignore($funcionario->id)],
            'email' => ['sometimes', 'email', 'min:10', 'max:50', Rule::unique('funcionarios')->ignore($funcionario->id)],
            'nome' => 'sometimes|string|min:10|max:50',
            'endereco' => 'sometimes|string|min:10|max:100',
            'unidade_id' => 'sometimes|exists:unidades,id',
            'senha' => 'sometimes|string|min:6'
        ]);

        $funcionario->update($validated);
        return response()->json($funcionario);
    }

    public function destroy (string $id): JsonResponse
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return response()->json(null, 204);

    }
}
