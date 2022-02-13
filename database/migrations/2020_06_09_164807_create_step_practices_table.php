<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepPracticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step_practices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('practice_id');
            $table->string('titulo', 500)->nullable();
            $table->string('desc', 5000)->nullable();
            $table->integer('numero')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('practice_id')->references('id')->on('practices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('step_practices');
    }
}
