<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razorpay_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->foreignId('order_id')->constrained('razorpay_orders');
            $table->float('paid_amount');
            $table->string('currency');
            $table->boolean('refunded')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('razorpay_transactions');
    }
};
