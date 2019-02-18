<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id')->unsigned();
            $table->string('label',255)->nullable();
            $table->string('group_sector',255)->nullable();
            $table->text('description')->nullable();
            $table->text('area')->nullable();
            $table->string('height', 255)->nullable();
            $table->integer('preferred_type')->nullable();
            $table->integer('gym_grade_id')->unsigned()->nullable();
            $table->timestamps();

            //clé étrangère
            $table->foreign('room_id')->references('id')->on('gym_rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gym_sectors');
    }
}
