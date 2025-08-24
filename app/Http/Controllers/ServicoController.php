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
        $rules = [
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
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 402);
        }

        $servico = Servico::create($request->all());
        return response()->json($servico, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $servico = Servico::findOrFail($id);

        $rules = [
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
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 402);
        }

        $servico->update($request->all());
        return response()->json($servico, 201);
    }
}
