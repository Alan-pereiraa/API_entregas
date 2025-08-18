<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rastreamento extends Model
{
    protected $fillable = [
        'status',
        'data_hora',
        'observacoes',
        'encomenda_id', // FK
        'unidade_id', // FK
    ];

    public function unidade (){
        return $this->belongsTo(Unidade::class);
    }

    public function encomenda (){
        return $this->belongsTo(Encomenda::class);
    }
}
