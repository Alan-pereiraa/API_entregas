<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente_Pessoa extends Model
{
    protected $filllable = [
        'nome',
        'cpf',
        'cliente_id' // FK
    ];

    public function cliente (){
        return $this->belongsTo(Cliente::class);
    }
}
