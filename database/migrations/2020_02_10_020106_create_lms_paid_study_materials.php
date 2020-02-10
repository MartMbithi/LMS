<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsPaidStudyMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_paid_study_materials', function (Blueprint $table) {
            $table->bigIncrements('psm_id')->unique();
            $table->integer('ls_id');
            $table->string('c_code');
            $table->string('sm_number');
            $table->integer('c_id');
            $table->integer('cc_id');
            $table->string('c_name');
            $table->string('c_category');
            $table->integer('i_id');
            $table->string('i_name');
            $table->string('p_method');
            $table->string('p_code');
            $table->string('p_amt');
            $table->timestamp('p_date_paid');
            $table->integer('s_id');
            $table->string('s_name');
            $table->string('s_regno');
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
        Schema::dropIfExists('lms_paid_study_materials');
    }
}
