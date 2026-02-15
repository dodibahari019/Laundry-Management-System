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
            $table->dropColumn(['berat', 'jumlah']);

            // Tambah kolom baru
            $table->string('kategori_alamat')->nullable()->after('pickup_type');
            $table->text('instruksi_alamat')->nullable()->after('alamat_pickup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_orders', function (Blueprint $table) {
            $table->decimal('berat', 15, 2)->after('id_layanan');
            $table->integer('jumlah')->after('berat');
            $table->dropColumn(['kategori_alamat', 'instruksi_alamat']);
        });
    }
};
