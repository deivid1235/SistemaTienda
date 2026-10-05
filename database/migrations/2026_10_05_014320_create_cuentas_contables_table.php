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
        Schema::create('cuentas_contables', function (Blueprint $table) {
            $table->id();

            // Cuentas contables de VENTAS - Soles
            $table->string('venta_total_soles', 20)->nullable();
            $table->string('venta_igv_soles', 20)->nullable();
            $table->string('venta_subtotal_soles', 20)->nullable();

            // Cuentas contables de VENTAS - Dólares
            $table->string('venta_total_dolares', 20)->nullable();
            $table->string('venta_igv_dolares', 20)->nullable();
            $table->string('venta_subtotal_dolares', 20)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_contables');
    }
};
