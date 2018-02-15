<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('checkinDate');
            $table->dateTime('checkoutDate');
            $table->string('checkinHour');
            $table->string('checkoutHour');
            $table->string('checkinDetails');
            $table->string('checkoutDetails');
            $table->integer('nbNights');
            $table->integer('nbPersons');
            $table->boolean('isBooked');
            $table->text('description');
            $table->boolean('isActive');
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
        Schema::dropIfExists('mission');
    }
}
