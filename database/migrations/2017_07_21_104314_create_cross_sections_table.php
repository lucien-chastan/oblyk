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
            $table->integer('route_section_id')->unsigned(); //facile, juste, dur
            $table->timestamps();

            //clé étrangère
            $table->foreign('cross_id')->references('id')->on('crosses');
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
