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
            $table->date('pickup_date')->nullable()->after('status_order');
            $table->time('pickup_time')->nullable()->after('pickup_date');
            $table->enum('pickup_type', [
                'langsung',
                'satpam',
                'tetangga',
                'lainnya'
            ])->default('langsung')->after('pickup_time');

            $table->text('alamat_pickup')->nullable()->after('pickup_type');
            $table->text('instruksi_driver')->nullable()->after('alamat_pickup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_orders', function (Blueprint $table) {
             $table->dropColumn([
                'pickup_date',
                'pickup_time',
                'pickup_type',
                'alamat_pickup',
                'instruksi_driver'
            ]);
        });
    }
};
