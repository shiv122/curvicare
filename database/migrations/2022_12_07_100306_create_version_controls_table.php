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
        Schema::create('version_controls', function (Blueprint $table) {
            $table->id();
            $table->float('android_version', 8, 2)->default(0.00);
            $table->float('ios_version', 8, 2)->default(0.00);
            $table->boolean('android_force_update')->default(false);
            $table->boolean('ios_force_update')->default(false);
            $table->string('android_update_message')->nullable();
            $table->string('ios_update_message')->nullable();
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
        Schema::dropIfExists('version_controls');
    }
};
