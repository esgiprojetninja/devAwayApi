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
            $table->integer('from')->unsigned()->nullable();
            $table->foreign('from')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('to')->unsigned()->nullable();
            $table->foreign('to')->references('id')->on('user')->onUpdate('cascade')->onDelete('set null');
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
            $table->dropForeign('message_from_foreign');
            $table->dropForeign('message_to_foreign');
        });
    }
}
