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
        Schema::create('dietician_kycs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dietician_id')->constrained()->onDelete('cascade');
            $table->string('aadhar_card_number')->nullable();
            $table->text('aadhar_card_image')->nullable();
            $table->string('pan_card_number')->nullable();
            $table->text('pan_card_image')->nullable();
            $table->text('certificate');
            $table->enum('status', ['active', 'blocked'])->default('active');
            $table->softDeletes();
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
        Schema::dropIfExists('dietician_kycs');
    }
};
