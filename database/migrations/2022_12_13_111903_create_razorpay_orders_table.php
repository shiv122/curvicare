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
        Schema::create('razorpay_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->json('package');
            $table->foreignId('user_id')->constrained('users');
            $table->string('type')->comment('new,renew');
            $table->float('amount');
            $table->string('currency');
            $table->float('discount')->nullable();
            $table->string('coupon_code')->nullable();
            $table->float('tax')->nullable();
            $table->float('payable_amount');
            $table->string('status')->comment('pending,paid,failed')->default('pending');
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
        Schema::dropIfExists('razorpay_orders');
    }
};
