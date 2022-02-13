<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpVfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_vfs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unity_id')->unsigned();
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
        Schema::dropIfExists('tp_vfs');
    }
}
