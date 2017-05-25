<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route_id')->unsigned();
            $table->string('grade',10);
            $table->string('sub_grade',5);
            $table->integer('grade_val');
            $table->integer('section_height');
            $table->integer('nb_point');
            $table->integer('type_point');
            $table->integer('type_anchor');
            $table->integer('steepness');
            $table->integer('section_order');

            //clé étrangère
            $table->foreign('route_id')->references('id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('route_sections');
    }
}
