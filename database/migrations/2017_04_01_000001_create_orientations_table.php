<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrientationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orientations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orientable_id');
            $table->string('orientable_type',100);
            $table->boolean('north');
            $table->boolean('east');
            $table->boolean('south');
            $table->boolean('west');
            $table->boolean('north_east');
            $table->boolean('north_west');
            $table->boolean('south_east');
            $table->boolean('south_west');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orientations');
    }
}
