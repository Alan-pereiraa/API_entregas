<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne; 

class Cliente extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'endereco',
        'telefone',
        'email',
        'tipo'
    ];

    public function encomenda (){
        return $this->hasMany(Encomenda::class);
    }

    public function pessoa(): HasOne
    {
        return $this->hasOne(ClientePessoa::class);
    }

    public function empresa(): HasOne
    {
        return $this->hasOne(ClienteEmpresa::class);
    }
}
