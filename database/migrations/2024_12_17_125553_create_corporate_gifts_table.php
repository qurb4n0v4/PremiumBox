<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('corporate_gifts', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // Primary image of the gift
            $table->string('title'); // Title of the gift
            $table->string('paragraph'); // Short description or tagline
            $table->text('description')->nullable(); // Detailed description of the gift
            $table->json('images')->nullable(); // Additional images for the gift
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('corporate_gifts');
    }
};
