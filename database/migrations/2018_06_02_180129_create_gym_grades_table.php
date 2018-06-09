<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id')->unsigned();
            $table->text('color')->nullable();
            $table->integer('min_grade_val')->nullable();
            $table->integer('max_grade_val')->nullable();
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
        Schema::drop('gym_grades');
    }
}
