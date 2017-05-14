<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('crag_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('label',255);
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
        Schema::drop('sectors');
    }
}
