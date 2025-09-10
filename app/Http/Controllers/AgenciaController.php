<?php

namespace App\Http\Controllers;

use App\Models\Agencia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AgenciaController extends Controller
{
    public function index(): JsonResponse
    {
        $agencias = Agencia::all();

        return response()->json($agencias);
    }

    public function show($id): JsonResponse
    {
        $agencia = Agencia::findOrFail($id);

        return response()->json($agencia);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate($this->getValidationRules($request));

        $agencia = Agencia::create($validated);

        return response()->json($agencia, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $agencia = Agencia::findOrFail($id);

        $validated = $request->validate($this->getValidationRules($request, $agencia));

        $agencia->update($validated);

        return response()->json($agencia);
    }

    private function getValidationRules(Request $request, ?Agencia $agencia = null): array
    {
        $rules = [
            'razao_social' => ['required', 'string', 'min:3', 'max:50'],
            'nome_fantasia' => ['required', 'string', 'min:3', 'max:100'],
            'cnpj' => ['required', 'string', 'min:14', 'max:14'],
            'telefone' => ['required', 'string', 'min:11', 'max:11'],
            'email' => ['required', 'email', 'min:3', 'max:50'],
        ];

        if ($agencia) {
            $rules['razao_social'][] = Rule::unique('agencias')->ignore($agencia->id);
            $rules['cnpj'][] = Rule::unique('agencias')->ignore($agencia->id);
            $rules['telefone'][] = Rule::unique('agencias')->ignore($agencia->id);
            $rules['email'][] = Rule::unique('agencias')->ignore($agencia->id);

            foreach ($rules as $field => $fieldRules) {
                $rules[$field] = array_map(function ($rule) {
                    return $rule === 'required' ? 'sometimes' : $rule;
                }, $fieldRules);
            }
        } else {

            $rules['razao_social'][] = 'unique:agencias';
            $rules['cnpj'][] = 'unique:agencias';
            $rules['telefone'][] = 'unique:agencias';
            $rules['email'][] = 'unique:agencias';
        }

        return $rules;
    }
}
