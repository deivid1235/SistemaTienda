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
        Schema::create('cliente_externos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('tipo_documento', 20);
            $table->string('numero_documento', 20)->unique();
            $table->string('celular', 15);
            $table->boolean('acepta_terminos')->default(false);
            $table->boolean('declaracion_jurada')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_externos');
    }
};
