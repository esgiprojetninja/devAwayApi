<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->default("NULL")->unique();
            $table->string('userName');
            $table->string('lastName')->nullable();
            $table->string('firstName')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('password');
            $table->longText('languages')->nullable();
            $table->longText('skills')->nullable();
            $table->boolean('isActive')->default(1);
            $table->boolean('addressVerified')->default(0);
            $table->boolean('emailVerified')->default(1);
            $table->string('emailVerifiedToken');
            $table->tinyInteger('roles')->default(0);
            $table->longText('avatar');
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
}
