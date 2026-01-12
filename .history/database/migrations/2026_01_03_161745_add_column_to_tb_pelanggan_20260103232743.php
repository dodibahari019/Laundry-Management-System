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
            $table->string('password')->nullable()->after('email');

            $table->enum('auth_provider', ['local', 'google'])
                ->default('local')
                ->after('password');

            $table->string('provider_id')
                ->nullable()
                ->after('auth_provider');
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pelanggan', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropColumn('auth_provider');
            $table->dropColumn('provider_id');
        });
    }
};
