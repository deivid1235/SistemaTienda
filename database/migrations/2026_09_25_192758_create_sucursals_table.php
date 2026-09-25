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
        Schema::create('sucursals', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 150);
            $table->string('pais', 100);
            $table->string('departamento', 100);
            $table->string('provincia', 100);
            $table->string('distrito', 100);
            $table->string('direccion_fiscal', 255);
            $table->string('telefono', 30)->nullable();
            $table->string('direccion_comercial', 255)->nullable();
            $table->string('correo_contacto', 150)->nullable();
            $table->string('direccion_web', 255)->nullable();
            $table->text('informacion_adicional')->nullable();
            $table->string('codigo_sucursal', 20)->unique();
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursals');
    }
};
