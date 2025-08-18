<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $fillable = [
        'telefone',
        'endereco',
        'unidade_ativa', // CAST
        'agencia_id' // FK
    ];

    protected $cats = [
        'unidade_ativa' => 'boolean'
    ];

    public function agencia (){
        return $this->belongsTo(Agencia::class);
    }
}
