<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsCerts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_certs', function (Blueprint $table) {
            $table->bigIncrements('cert_id')->unique();
            $table->integer('en_id');
            $table->integer('s_id');
            $table->string('s_regno');
            $table->string('s_name');
            $table->string('s_unit_code');
            $table->string('s_unit_name');
            $table->integer('i_id');
            $table->string('i_name');
            $table->string('en_date');
            $table->timestamp('date_generated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lms_certs');
    }
}
