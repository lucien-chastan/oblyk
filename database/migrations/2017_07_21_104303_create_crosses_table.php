<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crosses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('status_id')->unsigned(); // on sight, flash, project, etc.
            $table->integer('mode_id')->unsigned(); // lead, second, etc.
            $table->integer('hardness_id')->unsigned(); // easy, middle, hard
            $table->integer('environment')->default(0); // 0 -> outdoor, 1 -> indoor
            $table->integer('attempt')->default(1);
            $table->integer('min_grade_val')->nullable();
            $table->integer('max_grade_val')->nullable();
            $table->dateTime('release_at');
            $table->timestamps();

            // Foreign key
            $table->foreign('mode_id')->references('id')->on('cross_modes');
            $table->foreign('hardness_id')->references('id')->on('cross_hardnesses');
            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('cross_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('crosses');
    }
}
