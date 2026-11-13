<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();
            $table->string('entorno', 20)->default('Demo');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('fecha_emision');
            $table->string('cliente_nombre', 255);
            $table->string('cliente_documento', 20)->nullable();
            // 01 = Factura, 03 = Boleta, 07 = Nota de crédito, 08 = Nota de débito
            $table->string('tipo_comprobante', 2);
            $table->string('serie', 10);
            $table->unsignedInteger('numero');
            $table->decimal('total', 12, 2)->default(0);
            // pendiente | enviado | rechazado | anulado
            $table->string('estado_envio', 20)->default('pendiente');
            $table->timestamp('fecha_envio')->nullable();
            $table->text('mensaje_sunat')->nullable();
            $table->timestamps();

            $table->index(['estado_envio', 'fecha_emision']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comprobantes');
    }
};
