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
        if (!Schema::hasTable('choose_items')) {
            Schema::create('choose_items', function (Blueprint $table) {
                $table->id();
                $table->string('company_name');
                $table->string('name');
                $table->decimal('price', 10, 2);
                $table->enum('button', ['Add to Box', 'Custom Product', 'Choose Variant']);
                $table->string('normal_image');
                $table->string('hover_image')->nullable();
                $table->string('category');
                $table->integer('production_time');
                $table->decimal('width', 8, 2);
                $table->decimal('height', 8, 2);
                $table->decimal('length', 8, 2);
                $table->timestamps();
            });
        }
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
