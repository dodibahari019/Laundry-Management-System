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
            $table->enum('auth_provider', ['local', 'google'])->after('password');
            $table->string('provider_id')->after('auth_provider');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pelanggan', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropColumn('gateway');
            $table->dropColumn('gateway_transaction_id');
        });
    }
};
