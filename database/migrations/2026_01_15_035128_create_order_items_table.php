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
         Schema::create('tb_order_items', function (Blueprint $table) {
            $table->string('id_order_item', 10)->primary();
            $table->string('id_order', 10);
            $table->foreign('id_order')->references('id_order')->on('tb_orders');
            $table->string('id_layanan', 10);
            $table->foreign('id_layanan')->references('id_layanan')->on('tb_layanan');

            $table->integer('qty')->default(1);
            $table->decimal('harga', 12, 2);
            $table->decimal('subtotal', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_order_items');
    }
};
