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
        if (!Schema::hasTable('custom_product_details')) {
            Schema::create('custom_product_details', function (Blueprint $table) {
                $table->id();

                // Əsas Məlumatlar
                $table->foreignId('choose_item_id')
                    ->constrained('choose_items')
                    ->onDelete('cascade');
                $table->boolean('same_day_delivery')->default(false);
                $table->text('description')->nullable();
                $table->json('images')->nullable(); // Əsas məhsul şəkilləri

                // Şəkil Yükləmə Parametrləri
                $table->boolean('allow_user_images')->default(false);
                $table->string('image_upload_title')->nullable();
                $table->integer('max_image_count')->nullable();

                // Variant Parametrləri
                $table->boolean('has_variants')->default(false);
                $table->string('variant_selection_title')->nullable();
                $table->json('variants')->nullable(); // [{ name: string, image: string, price: numeric }]

                // Mətn Sahəsi Parametrləri
                $table->boolean('has_custom_text')->default(false);
                $table->string('text_field_placeholder')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_product_details');
    }
};
