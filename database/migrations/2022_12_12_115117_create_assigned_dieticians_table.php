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
        Schema::create('assigned_dieticians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dietician_assignment_id')->constrained('dietician_assignments')->onDelete('cascade');
            $table->foreignId('dietician_id')->constrained('dieticians')->onDelete('cascade');
            $table->string('role')->default('dietician')->comment('dietician,assistant,substitute');
            $table->string('status')->default('pending')->comment('pending,assigned,completed,cancelled');
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
        Schema::dropIfExists('assigned_dieticians');
    }
};
