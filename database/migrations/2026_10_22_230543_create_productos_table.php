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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 200);
            $table->text('descripcion')->nullable();
            $table->string('modelo', 150)->nullable();
            $table->foreignId('categoria_productos_id')->constrained('categoria_productos');
            $table->foreignId('marca_id')->nullable()->constrained('marcas');
            $table->foreignId('unidad_id')->nullable()->constrained('unidads');
            $table->foreignId('moneda_id')->constrained('monedas');
            $table->foreignId('tipo_afectacion_igv_id')->nullable()->constrained('tipo_afectacion_igvs');
            $table->decimal('precio_unitario', 12, 2);
            $table->decimal('costo_unitario', 12, 2)->nullable();
            $table->boolean('incluye_igv')->default(true);
            $table->boolean('incluye_isc')->default(false);
            $table->string('codigo_interno', 50)->nullable()->unique();
            $table->string('codigo_barras', 100)->nullable()->unique();
            $table->string('codigo_sunat', 20)->nullable();
            $table->string('codigo_fabricante', 100)->nullable();
            $table->string('imagen_qr', 255)->nullable();
            $table->string('imagen', 255)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
