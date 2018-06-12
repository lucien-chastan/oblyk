<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sector_id')->unsigned();
            $table->text('reference')->nullable();
            $table->string('label',255)->nullable();
            $table->string('grade',255)->nullable();
            $table->integer('val_grade')->nullable();
            $table->text('description')->nullable();
            $table->string('color',255)->nullable();
            $table->integer('type');
            $table->integer('height')->nullable();
            $table->string('opener',255)->nullable();
            $table->date('opener_date')->nullable();
            $table->boolean('dismounted')->default(false);
            $table->timestamps();

            //clé étrangère
            $table->foreign('sector_id')->references('id')->on('gym_sectors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gym_routes');
    }
}
