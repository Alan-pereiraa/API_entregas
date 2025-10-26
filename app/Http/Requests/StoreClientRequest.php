<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreClientRequest extends FormRequest
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
        $rules = [
            'tipo' => 'required|in:pessoa,empresa',
            'endereco' => 'required|string|min:10|max:50',
            'telefone' => 'required|string|min:11|max:11|unique:clientes',
            'email' => 'required|email|min:10|max:50|unique:clientes',
        ];
        
        if ($this->input('tipo') === 'pessoa') {
            $rules['nome'] = 'required|string|min:10|max:100';
            $rules['cpf'] = 'required|string|min:11|max:11|unique:cliente_pessoas';
        } else if ($this->input('tipo') === 'empresa') {
            $rules['razao_social'] = 'required|string|min:10|max:50|unique:cliente_empresas';
            $rules['nome_fantasia'] = 'required|string|min:10|max:100|unique:cliente_empresas';
            $rules['cnpj'] = 'required|string|min:14|max:14|unique:cliente_empresas';
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
            
            'tipo.required' => 'O tipo de cliente é obrigatório.',
            'tipo.in' => 'O tipo deve ser pessoa ou empresa.',
            'endereco.required' => 'O endereço é obrigatório.',
            'nome.required' => 'O nome é obrigatório para pessoa física.',
        ];
    }

}
