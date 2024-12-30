<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title_small')->nullable();
            $table->string('title_large');
            $table->text('description')->nullable();
            $table->string('button_text');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('slides');
    }
}
