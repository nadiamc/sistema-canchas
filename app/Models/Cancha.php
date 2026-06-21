<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cancha extends Model
{
    protected $fillable = [
        'nombre',
        'tipo',
        'precio_hora'
    ];

    protected $casts = [
        'precio_hora' => 'float',
    ];
}
