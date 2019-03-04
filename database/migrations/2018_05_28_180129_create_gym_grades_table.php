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
            $table->integer('gym_id')->unsigned();
            $table->string('label', 255)->nullable();
            $table->boolean('difficulty_is_tag_color')->default(true);
            $table->boolean('difficulty_is_hold_color')->default(false);
            $table->boolean('has_hold_color')->default(true);
            $table->integer('difficulty_system')->default(0);
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
        Schema::drop('gym_grades');
    }
}
