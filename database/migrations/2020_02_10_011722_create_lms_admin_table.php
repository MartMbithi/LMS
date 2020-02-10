<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_admin', function (Blueprint $table) {
            $table->bigIncrements('a_id')->unique();
            $table->string('a_name');
            $table->string('a_uname');
            $table->string('a_pwd');
            $table->string('a_dpic');
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
        Schema::dropIfExists('lms_admin');
    }
}
