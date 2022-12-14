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
        Schema::create('dietician_expertises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dietician_id')->constrained('dieticians')->onDelete('cascade');
            $table->foreignId('expertise_id')->constrained('expertises')->onDelete('cascade');

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
        Schema::dropIfExists('dietician_expertises');
    }
};
