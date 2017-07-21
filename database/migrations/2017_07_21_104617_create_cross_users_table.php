<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrossUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cross_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cross_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            //clé étrangère
            $table->foreign('cross_id')->references('id')->on('cross');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cross_users');
    }
}
