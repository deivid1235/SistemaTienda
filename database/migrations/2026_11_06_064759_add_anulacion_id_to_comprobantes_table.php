<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comprobantes', function (Blueprint $table) {
            $table->unsignedBigInteger('anulacion_id')->nullable()->after('resumen_id')->index();
        });
    }

    public function down(): void
    {
        Schema::table('comprobantes', function (Blueprint $table) {
            $table->dropIndex(['anulacion_id']);
            $table->dropColumn('anulacion_id');
        });
    }
};
