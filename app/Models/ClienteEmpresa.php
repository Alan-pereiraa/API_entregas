<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteEmpresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
