<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrossSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cross_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cross_id')->unsigned(); //croix
            $table->integer('status_id')->unsigned(); //à vue, flash, projet, etc.
            $table->integer('mode_id')->unsigned(); //en tête, moulinette, etc.
            $table->integer('hardness_id')->unsigned(); //facile, juste, dur
            $table->integer('route_section_id')->unsigned(); //facile, juste, dur
            $table->timestamps();

            //clé étrangère
            $table->foreign('cross_id')->references('id')->on('cross');
            $table->foreign('status_id')->references('id')->on('cross_status');
            $table->foreign('mode_id')->references('id')->on('cross_modes');
            $table->foreign('hardness_id')->references('id')->on('cross_hardness');
            $table->foreign('route_section_id')->references('id')->on('route_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cross_sections');
    }
}
