<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMassiveCragsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massive_crags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('massive_id')->unsigned();
            $table->integer('crag_id')->unsigned();
            $table->timestamps();

            //clé étrangère
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('massive_id')->references('id')->on('massives');
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
        Schema::drop('massive_crags');
    }
}
