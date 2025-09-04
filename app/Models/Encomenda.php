<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function frete (){
        return $this->hasOne(Frete::class);
    }

    public function dataPrevistaEntrega()
    {
        return $this->created_at->copy()->addDays($this->servico->prazo_dias);
    }

}
