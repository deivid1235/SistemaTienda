<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anulacions', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_emision');
            $table->date('fecha_comprobante');
            $table->string('identificador', 30)->unique();
            // pendiente | aceptado | rechazado
            $table->string('estado', 20)->default('pendiente');
            $table->string('ticket', 30)->nullable();
            $table->string('motivo', 255);
            $table->unsignedInteger('cantidad_comprobantes')->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('fecha_comprobante');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anulacions');
    }
};
