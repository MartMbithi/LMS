<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsEnrollments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_enrollments', function (Blueprint $table) {
            $table->bigIncrements('en_id')->unique();
            $table->string('s_name');
            $table->string('s_regno');
            $table->string('s_unit_code');
            $table->string('s_unit_name');
            $table->string('i_name');
            $table->string('cc_id');
            $table->integer('c_id');
            $table->integer('i_id');
            $table->integer('s_id');
            $table->string('s_course');
            $table->timestamp('en_date');
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
        Schema::dropIfExists('lms_enrollments');
    }
}
