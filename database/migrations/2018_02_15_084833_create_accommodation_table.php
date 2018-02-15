<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('city');
            $table->string('country');
            $table->string('address');
            $table->float('longitude');
            $table->float('latitude');
            $table->integer('nbBedroom');
            $table->integer('nbBathroom');
            $table->integer('nbToilet');
            $table->integer('nbMaxBaby');
            $table->integer('nbMaxChild');
            $table->integer('nbMaxGuest');
            $table->integer('nbMaxAdult');
            $table->boolean('animalsAllowed');
            $table->boolean('smokersAllowed');
            $table->boolean('hasInternet');
            $table->float('propertySize');
            $table->integer('floor');
            $table->integer('minStay');
            $table->integer('maxStay');
            $table->string('type');
            $table->dateTime('checkinHour');
            $table->dateTime('checkoutHour');
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
        Schema::dropIfExists('accommodation');
    }
}
