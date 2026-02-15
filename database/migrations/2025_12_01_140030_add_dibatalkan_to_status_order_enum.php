<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tb_orders', function (Blueprint $table) {
            // Ubah ENUM status_order dengan menambahkan 'dibatalkan'
            DB::statement("ALTER TABLE tb_orders MODIFY status_order
                ENUM('menunggu', 'diproses', 'dicuci', 'disetrika', 'ready', 'diambil', 'dibatalkan')
            ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_orders', function (Blueprint $table) {
            // Kembalikan enum ke versi sebelumnya (tanpa 'dibatalkan')
            DB::statement("ALTER TABLE tb_orders MODIFY status_order
                ENUM('menunggu', 'diproses', 'dicuci', 'disetrika', 'ready', 'diambil')
            ");
        });
    }
};
