<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('premade_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->string('normal_image');
            $table->string('hover_image');
            $table->enum('recipient', ['kişi', 'qadın', 'qız uşağı', 'oğlan uşağı', 'hər ikisi'])->nullable();
            $table->string('occasion')->nullable();
            $table->integer('production_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premade_boxes');
    }
};
