<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTpresueltosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpresueltos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->integer('tp_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('tp_id')->references('id')->on('tps');            
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('tpresueltos');
    }
}
