<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePictureAccommodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('picture_accommodation', function (Blueprint $table) {
            $table->integer('accommodation_id')->unsigned();
            $table->foreign('accommodation_id')->references('id')->on('accommodation')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('picture_accommodation', function (Blueprint $table) {
            $table->dropForeign('picture_accommodation_accommodation_id_foreign');
        });
    }
}
