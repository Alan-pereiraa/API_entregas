<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    protected $fillable = [
        'data_hora_postagem',
        'peso',
        'cliente_remetente_id', // FK
        'cliente_destinatario_id', // FK
        'servico_id', // FK
    ];

    public function destinatario (){
        return $this->belongsTo(Cliente::class, 'cliente_destinatario_id');
    }

    public function remetente (){
        return $this->belongsTo(Cliente::class, 'cliente_remetente_id');
    }

    public function servico (){
        return $this->belongsTo(Servico::class);
    }

    public function rastreamento (){
        return $this->hasMany(Rastreamento::class);
    }

}
