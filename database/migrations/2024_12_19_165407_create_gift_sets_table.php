<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftSetsTable extends Migration
{
    public function up()
    {
        Schema::create('gift_sets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('normal_image');
            $table->string('hover_image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gift_sets');
    }
}
