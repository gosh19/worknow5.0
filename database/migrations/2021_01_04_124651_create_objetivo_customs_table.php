<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetivoCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetivo_customs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Objetivo');
            $table->integer('objetivo')->unsigned()->default(36);
            $table->integer('premio')->unsigned();
            $table->date('desde');
            $table->date('hasta');
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('objetivo_customs');
    }
}
