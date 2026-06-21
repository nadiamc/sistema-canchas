<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    // Campos permitidos para carga masiva
    protected $fillable = [
    'user_id',
    'cancha_id', 
    'fecha', 
    'hora_inicio',
    'hora_fin',
    'estado',
    'total'];

    /**
     * Relación: Una reserva pertenece a una Cancha.
     */
    public function cancha()
    {
        return $this->belongsTo(Cancha::class);
    }

    /**
     * Relación: Una reserva pertenece a un Usuario (Cliente).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
