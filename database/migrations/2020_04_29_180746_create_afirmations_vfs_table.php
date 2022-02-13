<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfirmationsVfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afirmation_vfs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('afirmation', 2000)->default('text');
            $table->boolean('true')->default(false);
            $table->unsignedBigInteger('tpvf_id');
            $table->timestamps();

            $table->foreign('tpvf_id')->references('id')->on('tp_vfs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('afirmations_vfs');
    }
}
