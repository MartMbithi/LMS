<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_student', function (Blueprint $table) {
            $table->bigIncrements('s_id')->unique();
            $table->string('s_regno');
            $table->string('s_course');
            $table->string('s_name');
            $table->string('s_email');
            $table->string('s_pwd');
            $table->string('s_phoneno');
            $table->string('s_dob');
            $table->string('s_gender');
            $table->string('s_dpic');
            $table->string('s_acc_stats');
            $table->longText('s_bio');
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
        Schema::dropIfExists('lms_student');
    }
}
