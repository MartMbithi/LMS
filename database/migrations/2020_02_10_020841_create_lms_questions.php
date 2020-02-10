<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_questions', function (Blueprint $table) {
            $table->bigIncrements('q_id')->unique();
            $table->string('q_code');
            $table->integer('c_id');
            $table->integer('cc_id');
            $table->string('c_code');
            $table->string('c_name');
            $table->integer('i_id');
            $table->longText('q_details');
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
        Schema::dropIfExists('lms_questions');
    }
}
