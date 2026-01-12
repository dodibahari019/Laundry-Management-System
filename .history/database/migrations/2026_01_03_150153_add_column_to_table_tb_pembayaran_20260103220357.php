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
        Schema::table('tb_pembayaran', function (Blueprint $table) {
            $table->string('gateway')->nullable()->after('metode');
            $table->string('gateway_transaction_id')->nullable()->after('gateway');
            $table->string('status')->default('pending')->after('jumlah');
            $table->decimal('amount_paid', 15, 2)->nullable()->after('status');
            $table->timestamp('paid_at')->nullable()->after('amount_paid');
            $table->text('raw_response')->nullable()->after('paid_at');
            $table->json('payment_method_details')->nullable()->after('raw_response');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pembayaran', function (Blueprint $table) {
            $table->dropColumn('useraname');
            $table->dropColumn('gateway');
            $table->dropColumn('gateway_transaction_id');
            $table->dropColumn('status')->default('pending')->after('jumlah');
            $table->dropColumn('amount_paid', 15, 2)->nullable()->after('status');
            $table->dropColumn('paid_at')->nullable()->after('amount_paid');
            $table->dropColumn('raw_response')->nullable()->after('paid_at');
            $table->dropColumn('payment_method_details')->nullable()->after('raw_response');
        });
    }
};
