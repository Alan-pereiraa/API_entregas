<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;
    protected $fillable = [
        'telefone',
        'endereco',
        'unidade_ativa', 
        'agencia_id' 
    ];

    protected $casts = [
        'unidade_ativa' => 'boolean'
    ];

    public function agencia (){
        return $this->belongsTo(Agencia::class);
    }
}
