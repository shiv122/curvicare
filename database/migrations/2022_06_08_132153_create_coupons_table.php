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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->unique();
            $table->enum('discount_type', ['percentage', 'amount'])->default('percentage');
            $table->integer('discount_value');
            $table->enum('currency', ['INR', 'USD'])->default('INR');
            $table->integer('max_discount_amount')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->dateTime('expiry_date')->nullable();
            $table->dateTime('start_date')->nullable();
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
        Schema::dropIfExists('coupons');
    }
};
