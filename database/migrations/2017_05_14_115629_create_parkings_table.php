<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('crag_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('description',2000)->nullable();
            $table->double('lat',9,6);
            $table->double('lng',9,6);
            $table->timestamps();

            //clé étrangère
            $table->foreign('crag_id')->references('id')->on('crags');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('parkings');
    }
}
