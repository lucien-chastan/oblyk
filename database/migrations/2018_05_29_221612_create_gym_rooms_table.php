<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gym_id')->unsigned();
            $table->string('label',255)->nullable();
            $table->text('description')->nullable();
            $table->string('banner_color', 50)->nullable();
            $table->string('banner_bg_color', 50)->nullable();
            $table->string('scheme_bg_color', 50)->nullable();
            $table->integer('scheme_height')->nullable();
            $table->integer('scheme_width')->nullable();
            $table->double('lat',9,6)->nullable();
            $table->double('lng',9,6)->nullable();
            $table->softDeletes();
            $table->timestamps();

            //clé étrangère
            $table->foreign('gym_id')->references('id')->on('gyms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gym_rooms');
    }
}
