<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('pop_up_homes', function (Blueprint $table) {
            $table->id();
            $table->string('title1');
            $table->string('image1');
            $table->string('title2');
            $table->string('image2');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('pop_up_homes');
    }
};
