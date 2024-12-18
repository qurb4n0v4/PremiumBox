<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreignId('blog_id')->constrained()->onDelete('cascade');

        });
    }


    public function down()
    {
        Schema::dropIfExists('blog_details');
    }
};
