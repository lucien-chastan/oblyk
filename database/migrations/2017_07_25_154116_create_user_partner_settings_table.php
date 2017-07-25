<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPartnerSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_partner_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->boolean('partner')->nullable()->default(0);
            $table->text('description')->nullable();
            $table->boolean('climb_1')->default(0);
            $table->boolean('climb_2')->default(0);
            $table->boolean('climb_3')->default(0);
            $table->boolean('climb_4')->default(0);
            $table->boolean('climb_5')->default(0);
            $table->boolean('climb_6')->default(0);
            $table->boolean('climb_7')->default(0);
            $table->boolean('climb_8')->default(0);
            $table->string('grade_max',10)->default('2a');
            $table->string('grade_min',10)->default('2a');
            $table->timestamps();

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
        Schema::drop('user_partner_settings');
    }
}
