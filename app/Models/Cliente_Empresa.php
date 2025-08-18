<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente_Empresa extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'cliente_id' // FK
    ];

    public function cliente (){
        return $this->belongsTo(Cliente::class);
    }
}
