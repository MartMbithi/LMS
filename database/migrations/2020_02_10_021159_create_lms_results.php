<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_results', function (Blueprint $table) {
            $table->bigIncrements('rs_id')->unique();
            $table->string('rs_code');
            $table->string('s_name');
            $table->string('s_regno');
            $table->integer('s_id');
            $table->string('s_unit_code');
            $table->string('s_unit_name');
            $table->string('i_name');
            $table->integer('cc_id');
            $table->integer('c_id');
            $table->integer('i_id');
            $table->integer('c_eos_marks');
            $table->integer('c_cat1_marks');
            $table->integer('c_cat2_marks');
            $table->timestamp('c_date_added');
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
        Schema::dropIfExists('lms_results');
    }
}
