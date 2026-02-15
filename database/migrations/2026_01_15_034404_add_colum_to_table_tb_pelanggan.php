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
        Schema::table('tb_pelanggan', function (Blueprint $table) {
            // Nama terpisah (opsional)
            $table->string('first_name')->nullable()->after('nama');
            $table->string('last_name')->nullable()->after('first_name');

            // Gender
            $table->enum('gender', ['L', 'P'])->nullable()->after('last_name');

            // Jenis kontak
            $table->enum('jenis_kontak', ['individu', 'perusahaan'])
                  ->default('individu')
                  ->after('gender');

            // Nama perusahaan (jika perusahaan)
            $table->string('company_name')->nullable()->after('jenis_kontak');

            // Kategori alamat
            $table->enum('kategori_alamat', ['rumah', 'kost', 'kantor', 'hotel'])
                  ->nullable()
                  ->after('company_name');

            // Alamat default
            $table->text('default_address')->nullable()->after('kategori_alamat');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pelanggan', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'gender',
                'jenis_kontak',
                'company_name',
                'kategori_alamat',
                'default_address',
            ]);
        });
    }
};
