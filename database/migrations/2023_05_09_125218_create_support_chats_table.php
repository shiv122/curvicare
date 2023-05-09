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
        Schema::create('support_chats', function (Blueprint $table) {
            $table->id();
            $table->string('message', 2000)->nullable();
            $table->string('file', 2000)->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('from', ['user', 'admin'])->default('user');
            $table->boolean('read_by_admin')->default(0);
            $table->boolean('read_by_user')->default(0);
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
        Schema::dropIfExists('support_chats');
    }
};
