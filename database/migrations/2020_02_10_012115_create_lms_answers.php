<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_answers', function (Blueprint $table) {
            $table->bigIncrements('an_id')->unique();
            $table->string('q_code');
            $table->string('an_code');
            $table->integer('cc_id');
            $table->integer('c_id');
            $table->string('c_code');
            $table->integer('i_id');
            $table->integer('q_id');
            $table->longText('q_details');
            $table->longText('ans_details');
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
        Schema::dropIfExists('lms_answers');
    }
}
