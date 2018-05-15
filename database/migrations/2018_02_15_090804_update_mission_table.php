<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mission', function (Blueprint $table) {
            $table->integer('accommodation')->unsigned()->nullable();
            $table->foreign('accommodation')->references('id')->on('accommodation')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('traveller')->unsigned()->nullable();
            $table->foreign('traveller')->references('id')->on('user')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mission', function (Blueprint $table) {
            $table->dropForeign('mission_accommodation_foreign');
            $table->dropForeign('mission_traveller_foreign');
        });
    }
}
