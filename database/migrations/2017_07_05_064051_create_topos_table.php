<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('label',255);
            $table->string('author',255)->nullable();
            $table->string('editor',255)->nullable();
            $table->integer('editionYear')->nullable();
            $table->decimal('price',5,2)->nullable();
            $table->string('ean',13)->nullable();
            $table->integer('page')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('views')->nullable()->default(0);
            $table->timestamps();

            //clé étrangère
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
        Schema::drop('topos');
    }
}
