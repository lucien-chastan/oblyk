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
            $table->boolean('north')->default(0);
            $table->boolean('east')->default(0);
            $table->boolean('south')->default(0);
            $table->boolean('west')->default(0);
            $table->boolean('north_east')->default(0);
            $table->boolean('north_west')->default(0);
            $table->boolean('south_east')->default(0);
            $table->boolean('south_west')->default(0);
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
