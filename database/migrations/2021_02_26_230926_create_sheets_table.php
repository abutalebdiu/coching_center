<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('classes_id');
            $table->integer('sessiones_id');
            //$table->integer('batch_id')->nullable();
            $table->integer('batch_setting_id');
            $table->integer('free_for');  /*1 online 2 offline 3 both 4 paid*/
            $table->string('amount')->nullable();
            $table->text('sheet_file')->nullable();
            $table->string('publish_date')->nullable();
            $table->string('download_times')->nullable();
            $table->string('status')->default(1);
            $table->string('user_id')->nullable();
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
        Schema::dropIfExists('sheets');
    }
}
