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
        Schema::create('libro_reclamos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 20);
            $table->string('numero_documento', 20);
            $table->string('primer_nombre', 100);
            $table->string('segundo_nombre', 100)->nullable();
            $table->string('primer_apellido', 100);
            $table->string('segundo_apellido', 100);
            $table->string('correo', 150);
            $table->string('telefono', 20);
            $table->string('direccion', 255);
            $table->string('departamento', 100);
            $table->string('provincia', 100);
            $table->string('distrito', 100);
            $table->string('servicio_contratado', 255);
            $table->string('numero_orden', 50)->nullable();
            $table->text('identificacion_servicio')->nullable();
            $table->decimal('monto_reclamado', 10, 2)->nullable();
            $table->string('tipo_reclamo', 20);
            $table->text('motivo');
            $table->text('detalle_solicitud');
            $table->text('pedido_concreto');
            $table->boolean('acepto_politicas')->default(true);
            $table->foreignId('clientes_id')->nullable()->constrained('clientes')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_reclamos');
    }
};
