<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $filllable = [
        'endereco',
        'telefone',
        'email',
        'tipo'
    ];

    public function encomenda (){
        return $this->hasMany(Encomenda::class);
    }
}
