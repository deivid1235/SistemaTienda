<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comprobantes', function (Blueprint $table) {
            $table->unsignedBigInteger('resumen_id')->nullable()->after('estado_envio')->index();
        });
    }

    public function down(): void
    {
        Schema::table('comprobantes', function (Blueprint $table) {
            $table->dropIndex(['resumen_id']);
            $table->dropColumn('resumen_id');
        });
    }
};
