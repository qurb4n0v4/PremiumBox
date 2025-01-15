<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('user_card_for_build_a_box', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('gift_box_id')->constrained('gift_boxes')->onDelete('cascade');
            $table->text('box_customization_text')->nullable();
            $table->string('selected_font')->nullable();

            // Item və variant əlaqələri
            $table->foreignId('choose_item_id')->constrained('choose_items')->onDelete('cascade');
            $table->json('selected_variants')->nullable();
            $table->text('user_text')->nullable();

            // Card məlumatları
            $table->foreignId('card_id')->constrained('cards')->onDelete('cascade');
            $table->string('recipient_name');
            $table->string('sender_name');
            $table->text('card_message')->nullable();

            $table->enum('status', ['pending', 'rejected', 'completed'])->default('pending');
            $table->timestamps();
        });

        // Item şəkilləri üçün cədvəl
        Schema::create('build_a_box_item_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_card_id')->constrained('user_card_for_build_a_box')->onDelete('cascade');
            $table->foreignId('choose_item_id')->constrained('choose_items')->onDelete('cascade');
            $table->binary('image');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Card şəkilləri üçün cədvəl
        Schema::create('build_a_box_card_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_card_id')->constrained('user_card_for_build_a_box')->onDelete('cascade');
            $table->foreignId('card_id')->constrained('cards')->onDelete('cascade');
            $table->binary('image');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('build_a_box_card_images');
        Schema::dropIfExists('build_a_box_item_images');
        Schema::dropIfExists('user_card_for_build_a_box');
    }
};
