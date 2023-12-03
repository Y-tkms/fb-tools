<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrangementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrangements', function (Blueprint $table) {
            $table->id();
            $table->text('information')->nullable();
            $table->string('other_item')->nullable();
            $table->unsignedBigInteger('arr_item_id')->nullable();
            $table->unsignedBigInteger('reservation_id');
            $table->timestamps();

            $table->foreign('arr_item_id')->references('id')->on('arr_items');
            $table->foreign('reservation_id')->references('id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arrangements');
    }
}
