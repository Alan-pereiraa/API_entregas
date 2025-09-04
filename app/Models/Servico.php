<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

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
