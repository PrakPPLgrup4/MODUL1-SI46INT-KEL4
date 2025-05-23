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
        Schema::create('journal', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->text('journal_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migratio ns.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal');
    }
};
