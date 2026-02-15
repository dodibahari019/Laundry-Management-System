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
            $table->timestamp('timestamp')->nullable()->after('provider_id');

            $table->enum('status', ['active', 'inactive'])
                ->default('inactive')
                ->after('timestamp');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pelanggan', function (Blueprint $table) {
            $table->dropColumn('timestamp');
            $table->dropColumn('status');
        });
    }
};
