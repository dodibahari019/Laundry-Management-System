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
        Schema::table('tb_orders', function (Blueprint $table) {
            $table->dropForeign(['id_layanan']);
            $table->dropColumn('id_layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_orders', function (Blueprint $table) {
            $table->string('id_layanan', 10)->after('id_pelanggan');
            $table->foreign('id_layanan')->references('id_layanan')->on('tb_layanan');
        });
    }
};
