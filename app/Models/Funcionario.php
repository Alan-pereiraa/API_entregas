<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'cpf',
        'nome',
        'email',
        'endereco',
        'telefone',
        'unidade_id', // FK
        'senha'
    ];

    public function unidade (){
        return $this->belongsTo(Unidade::class);
    }
}
