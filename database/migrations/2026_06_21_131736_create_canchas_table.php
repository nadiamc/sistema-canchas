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
        Schema::create('canchas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ejemplo: "Cancha 1", "Cancha Central"
            $table->string('tipo');   // Ejemplo: "Fútbol 5", "Paddle", "Tenis"
            $table->decimal('precio_hora', 8, 2); // Precio por hora con decimales
            $table->boolean('disponible')->default(true); // Para saber si se puede reservar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canchas');
    }
};
