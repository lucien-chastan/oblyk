<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGapGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gap_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('spreadable_id');
            $table->string('spreadable_type',100);
            $table->integer('min_grade_val');
            $table->integer('max_grade_val');
            $table->string('min_grade_text',100);
            $table->string('max_grade_text',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gap_grades');
    }
}
