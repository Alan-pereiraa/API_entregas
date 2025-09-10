<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf',
        'nome',
        'email',
        'endereco',
        'telefone',
        'unidade_id', // FK
    ];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
}
