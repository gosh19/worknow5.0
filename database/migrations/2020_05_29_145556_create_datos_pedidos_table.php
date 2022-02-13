<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_pedidos', function (Blueprint $table) {
            $table->unsignedBigInteger('carrito_id')->nullable();
            $table->primary('carrito_id');
            $table->string('codigo_seguimiento', 100)->nullable();
            $table->string('estado', 500)->nullable();
            $table->timestamps();
            
            $table->foreign('carrito_id')->references('id')->on('carritos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_pedidos');
    }
}
