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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Kullanıcıyı bağlama
            $table->unsignedBigInteger('gift_box_id'); // Hediye kutusunu bağlama
            $table->unsignedBigInteger('bag_id')->nullable(); // Çanta varsa bağlama
            $table->unsignedBigInteger('card_id')->nullable(); // Kart varsa bağlama
            $table->string('recipient_name'); // Alıcı adı
            $table->string('sender_name'); // Gönderici adı
            $table->text('box_contents')->nullable(); // Kutunun içeriği
            $table->string('status')->default('pending'); // Sipariş durumu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
