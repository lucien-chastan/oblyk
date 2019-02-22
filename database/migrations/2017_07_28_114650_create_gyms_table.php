<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gyms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('label', 255);
            $table->text('description')->nullable();
            $table->boolean('type_boulder');
            $table->boolean('type_route');
            $table->boolean('type_pan');
            $table->boolean('free')->default(1);
            $table->integer('views')->nullable()->default(0);
            $table->string('address',255);
            $table->string('postal_code',10);
            $table->char('code_country',2);
            $table->string('country',255);
            $table->string('city',255);
            $table->string('big_city',255);
            $table->string('region',255);
            $table->double('lat',9,6);
            $table->double('lng',9,6);
            $table->string('email',255)->nullable();
            $table->string('phone_number',20)->nullable();
            $table->string('web_site',255)->nullable();
            $table->integer('option_level')->nullable()->default(0);
            $table->dateTime('option_start_date')->nullable();
            $table->dateTime('option_end_date')->nullable();
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
        Schema::drop('gyms');
    }
}
