<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // User card üçün əsas cədvəl
        Schema::create('user_card_for_build_a_box', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('gift_box_id')->constrained('gift_boxes')->onDelete('cascade');
            $table->text('box_customization_text')->nullable();
            $table->string('selected_font')->nullable();

            // Card məlumatları
            $table->foreignId('card_id')->nullable()->constrained('cards')->onDelete('cascade');
            $table->string('recipient_name')->nullable();
            $table->string('sender_name')->nullable();
            $table->text('card_message')->nullable();
            $table->decimal('total_price', 10, 2)->nullable(); // Added total price column
            $table->enum('status', ['pending', 'rejected', 'completed'])->default('pending');
            $table->timestamps();
        });

        // User build a box card items cədvəli
        Schema::create('user_build_a_box_card_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_card_id')->constrained('user_card_for_build_a_box')->onDelete('cascade');
            $table->foreignId('choose_item_id')->nullable()->constrained('choose_items')->onDelete('cascade');
            $table->json('selected_variants')->nullable();
            $table->text('user_text')->nullable();
            $table->timestamps();
        });

        // Item şəkilləri cədvəli
        Schema::create('build_a_box_item_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_build_a_box_card_item_id')->constrained('user_build_a_box_card_items')->onDelete('cascade');
            $table->foreignId('choose_item_id')->constrained('choose_items')->onDelete('cascade');
            $table->binary('image'); // Bu sahə bir şəkili saxlayır
            $table->integer('order')->default(0); // Şəkil sırası
            $table->timestamps();
        });


        // Card şəkilləri cədvəli
        Schema::create('build_a_box_card_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_card_id')->constrained('user_card_for_build_a_box')->onDelete('cascade');
            $table->foreignId('card_id')->constrained('cards')->onDelete('cascade');
            $table->binary('image');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('build_a_box_card_images');
        Schema::dropIfExists('build_a_box_item_images');
        Schema::dropIfExists('user_build_a_box_card_items');
        Schema::dropIfExists('user_card_for_build_a_box');
    }
};
