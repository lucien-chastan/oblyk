<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymGradeLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_grade_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gym_grade_id')->unsigned();
            $table->string('label', 255)->nullable();
            $table->text('color')->nullable();
            $table->integer('grade_val')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('gym_grade_id')->references('id')->on('gym_grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gym_grade_lines');
    }
}
