<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_course', function (Blueprint $table) {
            $table->bigIncrements('c_id')->unique();
            $table->integer('cc_id');
            $table->integer('a_id');
            $table->integer('i_id');
            $table->string('c_code');
            $table->string('c_name');
            $table->string('c_category');
            $table->longText('c_desc');
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
        Schema::dropIfExists('lms_course');
    }
}
