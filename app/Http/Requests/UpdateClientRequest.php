<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('cliente');

        $rules = [
            'tipo' => 'required|in:pessoa,empresa',
            'endereco' => 'required|string|min:10|max:50',
            'telefone' => ['required', 'string', 'min:11', 'max:11', Rule::unique('clientes', 'telefone')->ignore($id)],
            'email' => ['required', 'email', 'min:10', 'max:50', Rule::unique('clientes', 'email')->ignore($id)],
        ];

        $tipo = $this->input('tipo');

        if ($tipo === 'pessoa') {
            $rules += [
                'nome' => 'required|string|min:10|max:100',
                'cpf' => ['required', 'string', 'min:11', 'max:11', Rule::unique('cliente_pessoas', 'cpf')->ignore($id, 'cliente_id')]
            ];
        } elseif ($tipo === 'empresa') {
            $rules += [
                'razao_social' => ['required', 'string', 'min:10', 'max:50', Rule::unique('cliente_empresas', 'razao_social')->ignore($id, 'cliente_id')],
                'nome_fantasia' => ['required', 'string', 'min:10', 'max:100', Rule::unique('cliente_empresas', 'nome_fantasia')->ignore($id, 'cliente_id')],
                'cnpj' => ['required', 'string', 'min:14', 'max:14', Rule::unique('cliente_empresas', 'cnpj')->ignore($id, 'cliente_id')]
            ];
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Erro de validação',
            'errors' => $validator->errors()
        ], 422));
    }

    public function messages()
    {
        return [
            'cpf.unique' => 'Este CPF já está cadastrado no sistema.',
            'email.unique' => 'Este e-mail já está em uso.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
            'razao_social.unique' => 'Esta razão social já existe.',
            'nome_fantasia.unique' => 'Este nome fantasia já existe.',
            'telefone.unique' => 'Este telefone já está em uso.',
        ];
    }

}
