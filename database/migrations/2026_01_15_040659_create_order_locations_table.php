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
        Schema::create('tb_order_locations', function (Blueprint $table) {
            $table->string('id_order_locations', 10)->primary();
            $table->string('id_order', 10);
            $table->foreign('id_order')->references('id_order')->on('tb_orders');

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->string('place_id')->nullable();
            $table->text('formatted_address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_order_locations');
    }
};
