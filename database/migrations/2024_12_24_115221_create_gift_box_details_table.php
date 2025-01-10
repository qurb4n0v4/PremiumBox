<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gift_box_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gift_box_id')->constrained('gift_boxes')->onDelete('cascade');
            $table->json('images');
            $table->string('box_name');
            $table->boolean('available_same_day_delivery')->default(false);
            $table->text('paragraph')->nullable();
            $table->text('additional')->nullable();
            $table->string('customize_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_box_details');
    }
};
