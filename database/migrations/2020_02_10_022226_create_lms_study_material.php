<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsStudyMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_study_material', function (Blueprint $table) {
            $table->bigIncrements('ls_id')->unique();
            $table->string('c_code');
            $table->string('sn_number');
            $table->integer('c_id');
            $table->integer('cc_id');
            $table->string('c_name');
            $table->string('c_category');
            $table->integer('i_id');
            $table->string('i_name');
            $table->longText('sm_materials');
            $table->string('sm_price');
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
        Schema::dropIfExists('lms_study_material');
    }
}
