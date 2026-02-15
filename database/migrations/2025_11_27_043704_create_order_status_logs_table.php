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
        Schema::create('tb_order_status_logs', function (Blueprint $table) {
            $table->string('id_order_status_log', 10)->primary();
            $table->string('id_order', 10);
            $table->foreign('id_order')->references('id_order')->on('tb_orders');
            $table->string('status', 50);
            $table->string('id_user', 10);
            $table->foreign('id_user')->references('id_user')->on('tb_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_order_status_logs');
    }
};
