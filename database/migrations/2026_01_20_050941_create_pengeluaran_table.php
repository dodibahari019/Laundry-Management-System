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
        Schema::create('tb_pengeluaran', function (Blueprint $table) {
            $table->id('id_pengeluaran');
            $table->string('nama_pengeluaran', 100);
            $table->text('deskripsi')->nullable();
            $table->decimal('jumlah', 15, 2);
            $table->date('tanggal_pengeluaran');
            $table->enum('kategori', ['operasional', 'peralatan', 'bahan', 'gaji', 'utilitas', 'lainnya']);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('bukti_pengeluaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengeluaran');
    }
};