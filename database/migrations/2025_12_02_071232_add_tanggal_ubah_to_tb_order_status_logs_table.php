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
        Schema::table('tb_order_status_logs', function (Blueprint $table) {
            $table->dateTime('tanggal_ubah')->nullable()->after('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_order_status_logs', function (Blueprint $table) {
            $table->dropColumn('tanggal_ubah');
        });
    }
};
