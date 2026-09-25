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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 20);
            $table->string('numero_documento', 30);
            $table->string('nombre', 100);
            $table->string('nombre_comercial', 150)->nullable();
            $table->string('codigo_interno', 50)->nullable();
            $table->string('nacionalidad', 100)->nullable();
            $table->foreignId('tipo_cliente_id')->constrained('tipo_clientes')->onDelete('restrict');
            $table->string('codigo_barra', 100)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('pais', 100)->nullable();
            $table->string('codigo_sucursal', 50)->nullable();
            $table->string('telefono', 30)->nullable();
            $table->string('correo_electronico', 150)->nullable();
            $table->string('sitio_web', 255)->nullable();
            $table->integer('dias_credito')->default(0);
            $table->text('observaciones')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
