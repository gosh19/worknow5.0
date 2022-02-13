<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceAnswerPracticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_answer_practices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('answer_practice_id');
            $table->string('url', 200)->nullable();
            $table->timestamps();

            $table->foreign('answer_practice_id')->references('id')->on('answer_practices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_answer_practices');
    }
}
