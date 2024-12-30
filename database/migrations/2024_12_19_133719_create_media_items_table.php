<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaItemsTable extends Migration
{
    public function up()
    {
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->string('media_path');
            $table->enum('media_type', ['image', 'video']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_items');
    }
}
