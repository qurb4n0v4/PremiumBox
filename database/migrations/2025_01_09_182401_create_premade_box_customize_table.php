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
        Schema::create('premade_box_customize', function (Blueprint $table) {
            $table->id();
            $table->foreignId('premade_boxes_id')
                ->constrained('premade_boxes')
                ->onDelete('cascade');
            $table->foreignId('gift_box_id')
                ->nullable()
                ->constrained('gift_boxes')
                ->onDelete('cascade');
            $table->foreignId('card_id')
                ->constrained('cards')
                ->onDelete('cascade');
            $table->string('name');
            $table->json('boxes')->nullable();
            $table->json('cards')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premade_box_customize');
    }
};
