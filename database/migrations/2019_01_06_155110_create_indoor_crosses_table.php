<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndoorCrossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indoor_crosses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('gym_id')->unsigned();
            $table->integer('room_id')->unsigned()->nullable();
            $table->integer('sector_id')->unsigned()->nullable();
            $table->integer('route_id')->unsigned()->nullable();
            $table->integer('height')->nullable();
            $table->integer('status_id')->unsigned(); // Flash, on sight, etc.
            $table->integer('mode_id')->unsigned();
            $table->integer('type')->nullable(); // Sport climbing, boulder, etc.
            $table->string('grade', 255)->nullable(); // 7a
            $table->string('sub_grade', 255)->nullable(); // + / -
            $table->string('color', 255)->nullable(); // hold color
            $table->integer('grade_val')->nullable(); // difficulty level
            $table->text('description')->nullable();
            $table->dateTime('release_at');
            $table->timestamps();

            // Foreign key
            $table->foreign('gym_id')->references('id')->on('gyms');
            $table->foreign('status_id')->references('id')->on('cross_statuses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('mode_id')->references('id')->on('cross_modes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('indoor_crosses');
    }
}
