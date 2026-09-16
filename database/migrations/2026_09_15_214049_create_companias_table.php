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
        Schema::create('companias', function (Blueprint $table) {
            $table->id();
            $table->string('ruc', 11); 
            $table->string('nombre', 255); 
            $table->string('nombre_comercial', 255);
            $table->string('logo', 255)->nullable(); 
            $table->string('cuenta_detraccion', 255)->nullable(); 
            $table->string('rubrica', 255)->nullable(); 
            $table->string('titulo_web', 255)->default('Facturación Electrónica'); 
            $table->string('logo_app', 255)->nullable();
            $table->enum('soap_tipo', ['demo', 'produccion']) ->default('demo'); 
            $table->enum('soap_envio', ['sunat', 'ose', 'osesendfact']) ->default('sunat'); 
            $table->string('soap_usuario', 255)->nullable(); 
            $table->string('soap_password', 255)->nullable();
            $table->string('cpe_client_id', 255)->nullable(); 
            $table->string('cpe_client_secret', 255)->nullable();
            $table->string('sire_client_id', 255)->nullable(); 
            $table->string('sire_client_secret', 255)->nullable(); 
            $table->string('sire_usuario', 255)->nullable(); 
            $table->string('sire_password', 255)->nullable();
            $table->boolean('qr_api')->default(false);
            $table->string('digital_certificate_qztray', 255)->nullable(); 
            $table->string('private_certificate_qztray', 255)->nullable();
            $table->boolean('pse_habilitado')->default(false); 
            $table->unsignedBigInteger('pse_proveedor_id')->nullable(); 
            $table->string('pse_usuario', 255)->nullable(); 
            $table->string('pse_password', 255)->nullable();
            $table->string('guias_soap_usuario', 255)->nullable();
            $table->string('guias_soap_password', 255)->nullable();
            $table->string('guias_client_id', 255)->nullable();
            $table->string('guias_client_secret', 255)->nullable();
            $table->boolean('yape_habilitado')->default(false); 
            $table->boolean('mercado_pago_habilitado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companias');
    }
};
