<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approaches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('crag_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('polyline');
            $table->text('description')->nullable();
            $table->integer('length');
            $table->timestamps();

            //clé étrangère
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('crag_id')->references('id')->on('crags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('approaches');
    }
}
