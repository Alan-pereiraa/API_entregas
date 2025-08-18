<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'preco_base',
        'prazo_dias'
    ];

    public function encomenda (){
        return $this->hasMany(Encomenda::class);
    }
}
