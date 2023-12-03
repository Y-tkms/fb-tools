<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name', 50);
            $table->integer('room_number')->nullable();
            $table->date('other_date')->nullable();
            $table->string('other_time')->nullable();
            $table->integer('people_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->text('preference')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('time_id')->nullable();
            $table->unsignedBigInteger('date_id')->nullable();
            $table->unsignedBigInteger('rsv_section_id');
            $table->timestamps();

            $table->foreign('time_id')->references('id')->on('times');
            $table->foreign('date_id')->references('id')->on('dates');
            $table->foreign('rsv_section_id')->references('id')->on('rsv_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
