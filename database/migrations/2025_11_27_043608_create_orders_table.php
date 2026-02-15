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
        Schema::create('tb_orders', function (Blueprint $table) {
            $table->string('id_order', 10)->primary();
            $table->string('kode_order', 50)->unique();
            $table->string('id_pelanggan', 10);
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('tb_pelanggan');
            $table->string('id_layanan', 10);
            $table->foreign('id_layanan')->references('id_layanan')->on('tb_layanan');
            $table->decimal('berat', 15, 2);
            $table->integer('jumlah');
            $table->decimal('total', 15, 2);
            $table->enum('status_order', ['menunggu', 'diproses', 'dicuci', 'disetrika', 'ready', 'diambil']);
            $table->text('catatan');
            $table->datetime('tanggal_masuk');
            $table->datetime('tanggal_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_orders');
    }
};
