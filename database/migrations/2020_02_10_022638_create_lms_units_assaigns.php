<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsUnitsAssaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_units_assaigns', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('c_code');
            $table->integer('c_id');
            $table->integer('cc_id');
            $table->string('c_name');
            $table->string('c_category');
            $table->integer('i_id');
            $table->string('i_number');
            $table->string('i_name');
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
        Schema::dropIfExists('lms_units_assaigns');
    }
}
