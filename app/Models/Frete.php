<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frete extends Model
{
    protected $fillable = [
        'encomenda_id', // FK
        'valor'
    ];

    public function encomenda (){
        return $this->belongsTo(Encomenda::class);
    }
}
