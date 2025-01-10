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
        Schema::create('premade_box_insidings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('premade_boxes_id')->default(1);
            $table->foreign('premade_boxes_id')
                ->references('id')
                ->on('premade_boxes')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('image');

            $table->boolean('allow_image_upload')->default(false);
            $table->string('image_upload_title')->nullable();
            $table->integer('max_image_count')->nullable();

            $table->boolean('allow_text')->default(false);
            $table->string('text_field_placeholder')->nullable();

            $table->boolean('allow_variant_selection')->default(false);
            $table->json('variant_options')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premade_box_insidings');
    }
};
