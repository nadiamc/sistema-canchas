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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            // Conectamos el pago con su respectiva Reserva (Clave Foránea)
            $table->foreignId('reserva_id')->constrained()->onDelete('cascade');
            
            // Datos del pago
            $table->decimal('monto', 8, 2); 
            $table->string('metodo_pago'); // Ejemplo: "Efectivo", "Transferencia"
            $table->string('estado')->default('pendiente'); // pendiente, pagado, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
