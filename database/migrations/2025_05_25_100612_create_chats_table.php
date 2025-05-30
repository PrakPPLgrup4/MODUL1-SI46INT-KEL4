<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_type'); // 'user' or 'psych'
            $table->unsignedBigInteger('receiver_id');
            $table->string('receiver_type'); // 'user' or 'psych'
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
