<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message', function (Blueprint $table) {
            $table->integer('candidate')->unsigned()->nullable();
            $table->foreign('candidate')->references('id')->on('candidate')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('mission')->unsigned()->nullable();
            $table->foreign('mission')->references('id')->on('mission')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message', function (Blueprint $table) {
            $table->dropForeign('message_mission_foreign');
            $table->dropForeign('message_candidate_foreign');
        });
    }
}
