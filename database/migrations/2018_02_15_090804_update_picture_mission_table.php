<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePictureMissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('picture_mission', function (Blueprint $table) {
            $table->integer('mission_id')->unsigned();
            $table->foreign('mission_id')->references('id')->on('mission')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('picture_mission', function (Blueprint $table) {
            $table->dropForeign('picture_mission_mission_id_foreign');
        });
    }
}
