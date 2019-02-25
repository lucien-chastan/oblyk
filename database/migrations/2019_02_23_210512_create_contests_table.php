<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gym_id')->unsigned();
            $table->text('description')->nullable();
            $table->string('label')->nullable();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->integer('participant_limit')->nullable();
            $table->integer('minutes_after_end')->default(0)->nullable();
            $table->boolean('real_time_result')->default(true);
            $table->boolean('subscribers_need_validation')->default(false);
            $table->string('validation_message')->nullable();
            $table->boolean('hide_route_before_contest')->default(true);
            $table->timestamps();

            // Foreign key
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
        Schema::drop('contests');
    }
}
