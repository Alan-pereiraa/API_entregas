<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rastreamento extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'data_hora',
        'concluido',
        'observacoes',
        'encomenda_id', // FK
        'unidade_id', // FK
    ];

    protected $casts = [
        'concluido' => 'boolean'
    ];

    public function unidade (){
        return $this->belongsTo(Unidade::class);
    }

    public function encomenda (){
        return $this->belongsTo(Encomenda::class);
    }
}
