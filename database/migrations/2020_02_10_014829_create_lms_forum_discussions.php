<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsForumDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_forum_discussions', function (Blueprint $table) {
            $table->bigIncrements('fd_id')->unique();
            $table->integer('i_id');
            $table->integer('s_id');
            $table->string('s_name');
            $table->longText('f_topic');
            $table->integer('c_id');
            $table->string('s_unit_code');
            $table->string('s_unit_name');
            $table->integer('f_no');
            $table->integer('f_id');
            $table->longText('f_ans');
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
        Schema::dropIfExists('lms_forum_discussions');
    }
}
