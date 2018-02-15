<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAccommodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accommodation', function (Blueprint $table) {
            $table->integer('pictures')->unsigned()->nullable();
            $table->foreign('pictures')->references('id')->on('picture')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('host')->unsigned()->nullable();
            $table->foreign('host')->references('id')->on('user')->onUpdate('cascade')->onDelete('set null');
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
