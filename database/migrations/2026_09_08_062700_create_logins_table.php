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
        Schema::create('logins', function (Blueprint $table) {
            $table->id();
            $table->enum('posicion_formulario', ['IZQUIERDA', 'DERECHA'])->default('DERECHA');
            $table->boolean('mostrar_logo')->default(true);
            $table->enum('posicion_logo', ['SUPERIOR_IZQUIERDA','SUPERIOR_CENTRO','SUPERIOR_DERECHA'])->default('SUPERIOR_IZQUIERDA');
            $table->boolean('mostrar_facebook')->default(false);
            $table->boolean('mostrar_twitter')->default(false);
            $table->boolean('mostrar_instagram')->default(false);
            $table->boolean('mostrar_linkedin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logins');
    }
};
