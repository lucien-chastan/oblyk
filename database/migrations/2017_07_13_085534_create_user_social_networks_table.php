<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSocialNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_social_networks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('social_network_id')->unsigned();
            $table->string('label',255)->nullable();
            $table->string('url',255);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('social_network_id')->references('id')->on('social_networks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_social_networks');
    }
}
