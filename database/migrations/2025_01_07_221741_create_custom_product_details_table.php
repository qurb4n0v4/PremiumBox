<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('custom_product_details', function (Blueprint $table) {
            $table->id();
            $table->boolean('same_day_delivery')->default(false); // Eyni Gün Çatdırılma Mövcuddur
            $table->text('description')->nullable(); // Açıklama
            $table->json('images')->nullable(); // Şəkillər

            // Admin tərəfindən təyin olunan "Şəkil əlavə et" funksiyası
            $table->boolean('require_user_images')->default(false); // Admin tərəfindən aktiv olunub-olmaması
            $table->string('user_image_title')->nullable(); // "Şəkil əlavə et" başlığı
            $table->integer('user_image_limit')->nullable(); // Şəkil limiti

            // Admin tərəfindən təyin olunan "Bunlardan birini seç" funksiyası
            $table->boolean('require_user_choices')->default(false); // Admin tərəfindən aktiv olunub-olmaması
            $table->string('user_choice_title')->nullable(); // "Bunlardan birini seç" başlığı
            $table->json('user_choices')->nullable(); // Seçimlər

            // Admin tərəfindən təyin olunan "Textarea" funksiyası
            $table->boolean('require_textarea')->default(false); // Admin tərəfindən aktiv olunub-olmaması
            $table->string('textarea_placeholder')->nullable(); // Textarea üçün placeholder

            $table->timestamps(); // Yaradılma və yenilənmə tarixləri
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_product_details');
    }
};
