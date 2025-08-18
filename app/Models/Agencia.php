<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agencia extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'telefone',
        'email'
    ];

    public function unidades (){
        return $this->hasMany(Unidade::class);
    }
}
