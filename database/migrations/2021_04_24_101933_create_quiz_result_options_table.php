<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizResultOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_result_options', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('classes_id');
            $table->integer('sessiones_id');
            $table->integer('batch_setting_id');
            $table->integer('quiz_id');
            $table->integer('quiz_question_id');
            $table->integer('quiz_question_option_id');
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
        Schema::dropIfExists('quiz_result_options');
    }
}
