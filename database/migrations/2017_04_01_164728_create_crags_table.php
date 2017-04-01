<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCragsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label',255);
            $table->integer('rock');
            $table->char('code_country',2);
            $table->string('country',255);
            $table->string('region',255);
            $table->integer('user_id')->unsigned();
            $table->double('lat',9,6);
            $table->double('lng',9,6);
            $table->softDeletes();
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
        Schema::table('crags', function (Blueprint $table) {$table->dropForeign(['user_id']);});
        Schema::drop('crags');
    }
}
