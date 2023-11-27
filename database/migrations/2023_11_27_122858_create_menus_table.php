<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->integer('price')->nullable();
            $table->string('image', 50)->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('preference_id')->nullable();
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('menu_sections');
            $table->foreign('preference_id')->references('id')->on('menu_preferences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
