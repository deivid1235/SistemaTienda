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
        Schema::create('estilos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('color', 20);
            $table->string('modo', 20);
            $table->string('menu_lateral', 20);
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('INACTIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estilos');
    }
};
