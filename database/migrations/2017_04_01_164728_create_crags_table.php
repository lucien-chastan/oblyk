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
            $table->integer('rock_id')->unsigned();
            $table->integer('photo_id')->nullable()->unsigned();
            $table->string('bandeau', 255)->nullable();
            $table->char('code_country',2);
            $table->string('country',255);
            $table->string('city',255);
            $table->string('region',255);
            $table->integer('user_id')->unsigned();
            $table->double('lat',9,6);
            $table->double('lng',9,6);
            $table->boolean('type_voie');
            $table->boolean('type_grande_voie');
            $table->boolean('type_bloc');
            $table->boolean('type_deep_water');
            $table->boolean('type_via_ferrata');
            $table->softDeletes();
            $table->timestamps();

            //clé étrangère
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rock_id')->references('id')->on('rocks');
            $table->foreign('photo_id')->references('id')->on('photos');
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
        Schema::table('crags', function (Blueprint $table) {$table->dropForeign(['rock_id']);});
        Schema::drop('crags');
    }
}
