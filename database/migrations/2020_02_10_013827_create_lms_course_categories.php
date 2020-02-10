<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsCourseCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_course_categories', function (Blueprint $table) {
            $table->bigIncrements('cc_id')->unique();
            $table->string("cc_name");
            $table->string('cc_dept_head');
            $table->string('cc_code');
            $table->longText('cc_desc');
            $table->string('cc_dpic');
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
        Schema::dropIfExists('lms_course_categories');
    }
}
