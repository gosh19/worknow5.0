<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpFinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_finals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unity_id')->unsigned();
            $table->string('url');
            $table->timestamps();

            $table->foreign('unity_id')->references('id')->on('unities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tp_finals');
    }
}
