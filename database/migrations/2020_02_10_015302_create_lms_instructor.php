<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsInstructor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_instructor', function (Blueprint $table) {
            $table->bigIncrements('i_id');
            $table->string('i_number');
            $table->string('i_name');
            $table->string('i_email');
            $table->string('i_phone');
            $table->string('i_pwd');
            $table->string('i_dpic');
            $table->longText('i_bio');
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
        Schema::dropIfExists('lms_instructor');
    }
}
