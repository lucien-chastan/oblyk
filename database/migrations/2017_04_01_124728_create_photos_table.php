<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('illustrable_id');
            $table->string('illustrable_type',100);
            $table->string('slug_label',255);
            $table->integer('user_id')->unsigned();
            $table->integer('album_id')->unsigned();
            $table->text('description')->nullable();
            $table->string('exif_model', 255)->nullable();
            $table->string('exif_make', 255)->nullable();
            $table->string('source', 255)->nullable();
            $table->string('alt', 255)->nullable();
            $table->boolean('copyright_by')->nullable();
            $table->boolean('copyright_nc')->nullable();
            $table->boolean('copyright_nd')->nullable();
            $table->timestamps();

            //clé étrangère
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('album_id')->references('id')->on('albums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('photos');
    }
}
