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
        if (!Schema::hasTable('choose_variants')) {
            Schema::create('choose_variants', function (Blueprint $table) {
                $table->id();
                $table->foreignId('choose_item_id')->constrained('choose_items')->onDelete('cascade');
                $table->string('images')->nullable();
                $table->boolean('available_same_day_delivery')->default(false);
                $table->text('paragraph')->nullable();
                $table->boolean('has_variants')->default(false);
                $table->string('variant_selection_title')->nullable();
                $table->json('variants')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choose_variants');
    }
};
