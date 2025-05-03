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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('login_streak')->default(0);
            $table->integer('journal_streak')->default(0);
            $table->integer('mood_streak')->default(0);
            $table->date('last_login_date')->nullable();
            $table->date('last_journal_date')->nullable();
            $table->date('last_mood_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
