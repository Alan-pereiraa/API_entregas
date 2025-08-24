<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientePessoa extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'cliente_id' 
    ];

    public function cliente (){
        return $this->belongsTo(Cliente::class);
    }
}
