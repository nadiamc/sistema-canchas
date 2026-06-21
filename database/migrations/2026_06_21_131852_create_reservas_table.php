<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            // Claves foráneas (Relaciones exigidas por la UTN)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');    // Conecta con el Cliente
            $table->foreignId('cancha_id')->constrained()->onDelete('cascade');  // Conecta con la Cancha
            
            // Datos del turno
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('estado')->default('confirmada'); // Por defecto se crea confirmada
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};