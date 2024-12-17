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
            $table->string('image');
            $table->string('title');
            $table->string('paragraph');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('corporate_gifts');
    }
};
