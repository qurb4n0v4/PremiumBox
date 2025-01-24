<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. `user_card_for_premade_boxes` table
        Schema::create('user_card_for_premade_boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('premade_box_id')->constrained('premade_boxes')->onDelete('cascade');
            $table->foreignId('gift_box_id')->constrained('gift_boxes')->onDelete('cascade');
            $table->string('box_text');
            $table->string('selected_font');
            $table->enum('status', ['pending', 'rejected', 'accepted'])->default('pending');
            $table->timestamps();
        });

        // 2. `user_card_details` table
        Schema::create('user_card_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_card_for_premade_box_id')
                ->constrained('user_card_for_premade_boxes')
                ->onDelete('cascade');
            $table->foreignId('card_id')
                ->nullable()
                ->constrained('cards')
                ->onDelete('set null');
            $table->string('to_name')->nullable();
            $table->string('from_name')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });

        // 3. `user_premade_box_items` table
        Schema::create('user_premade_box_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_card_for_premade_box_id')
                ->constrained('user_card_for_premade_boxes')
                ->onDelete('cascade');
            $table->foreignId('insiding_id')
                ->constrained('premade_box_insidings')
                ->onDelete('cascade');
            $table->string('selected_variant')->nullable();
            $table->text('custom_text')->nullable();
            $table->timestamps();
        });

        // 4. `user_premade_box_item_images` table
        Schema::create('user_premade_box_item_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_premade_box_item_id')
                ->constrained('user_premade_box_items')
                ->onDelete('cascade');
            $table->string('image_path');
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        // Tabloları tərs sırayla silirik
        Schema::dropIfExists('user_premade_box_item_images');
        Schema::dropIfExists('user_premade_box_items');
        Schema::dropIfExists('user_card_details');
        Schema::dropIfExists('user_card_for_premade_boxes');
    }
};
