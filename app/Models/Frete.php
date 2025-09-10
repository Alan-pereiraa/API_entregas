<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frete extends Model
{
    use HasFactory;

    protected $fillable = [
        'encomenda_id', // FK
        'valor',
    ];

    public function encomenda()
    {
        return $this->belongsTo(Encomenda::class);
    }
}
