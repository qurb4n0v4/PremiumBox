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
        Schema::create('premade_box_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('premade_box_id');
            $table->json('images')->nullable();
            $table->text('paragraph')->nullable();
            $table->timestamps();

            // Foreign key relation with premade_boxes
            $table->foreign('premade_box_id')
                ->references('id')->on('premade_boxes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premade_box_details');
    }
};
