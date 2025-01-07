<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChooseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choose_items', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('name');
            $table->decimal('price', 10, 2); // Adjust precision and scale as needed
            $table->enum('button', ['Add to Box', 'Custom Product', 'Choose Variant']); // Dropdown for button choices
            $table->string('normal_image'); // Required image
            $table->string('hover_image')->nullable(); // Optional image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choose_items');
    }
}
