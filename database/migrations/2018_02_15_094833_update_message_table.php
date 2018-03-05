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

            $table->integer('accommodation')->unsigned()->nullable();
            $table->foreign('accommodation')->references('id')->on('accommodation')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}
