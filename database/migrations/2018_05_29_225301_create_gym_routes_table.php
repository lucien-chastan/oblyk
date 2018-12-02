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
            $table->string('sub_grade',255)->nullable();
            $table->integer('val_grade')->nullable();
            $table->text('description')->nullable();
            $table->string('hold_color',255)->nullable();
            $table->string('tag_color',255)->nullable();
            $table->integer('type');
            $table->integer('height')->nullable();
            $table->boolean('favorite')->default(false);
            $table->string('opener',255)->nullable();
            $table->date('opener_date')->nullable();
            $table->date('dismounted_at')->nullable();
            $table->text('line')->nullable();
            $table->timestamps();

            // Foreign Key
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
