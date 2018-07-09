<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate', function (Blueprint $table) {
            $table->integer('mission_id')->unsigned()->nullable();
            $table->foreign('mission_id')->references('id')->on('mission')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('user')->unsigned()->nullable();
            $table->foreign('user')->references('id')->on('user')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate', function (Blueprint $table) {
            $table->dropForeign('candidate_mission_id_foreign');
            $table->dropForeign('candidate_user_foreign');
        });
    }
}
