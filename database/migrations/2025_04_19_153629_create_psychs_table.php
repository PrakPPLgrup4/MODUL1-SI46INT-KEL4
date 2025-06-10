<?php

// database/migrations/xxxx_xx_xx_create_psychs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsychsTable extends Migration
{
    public function up()
    {
        Schema::create('psychs', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->text('description');
            $table->string('picture')->nullable();
            $table->float('average_rating')->default(0);
            $table->unsignedInteger('rating_count')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('psychs');
    }
}

