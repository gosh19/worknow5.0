<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_infos', function (Blueprint $table) {
            $table->integer('course_id')->unsigned();
            $table->float('peso')->nullable()->default(1989);
            $table->float('dolar')->nullable()->default(23);
            $table->float('discount')->nullable()->default(0);
            $table->boolean('on')->default(false);
            $table->integer('people')->unsigned()->nullable();
            $table->float('score')->nullable();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_infos');
    }
}
