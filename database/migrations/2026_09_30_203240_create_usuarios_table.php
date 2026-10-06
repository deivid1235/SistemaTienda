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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('tipo_documento');
            $table->string('numero');
            $table->string('nombre');
            $table->string('apellidos');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('correo_personal')->nullable();
            $table->string('celular')->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha_contratacion')->nullable();
            $table->date('fecha_vencimiento_contrato')->nullable();
            $table->foreignId('sucursal_id')->constrained('sucursals')->restrictOnDelete();
            $table->foreignId('rol_id')->constrained('roles')->restrictOnDelete();
            $table->foreignId('tipo_documento_id')->constrained('tipo_documentos')->restrictOnDelete();
            $table->foreignId('serie_id')->constrained('series')->restrictOnDelete();
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
