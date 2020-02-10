<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsForum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_forum', function (Blueprint $table) {
            $table->bigIncrements('f_id')->unique();
            $table->integer('a_id');
            $table->integer('i_id');
            $table->longText('f_topic');
            $table->integer('c_id');
            $table->string('s_unit_code');
            $table->string('s_unit_name');
            $table->integer('f_no');
            $table->timestamp('f_date_posted');
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
        Schema::dropIfExists('lms_forum');
    }
}
