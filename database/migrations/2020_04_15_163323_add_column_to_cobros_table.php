<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCobrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cobros', function (Blueprint $table) {
            $table->date('fecha')->nullable();
        });

        $cobros = \App\Cobro::all();
        foreach ($cobros as $cobro ) {
            $cobro->fecha = $cobro->updated_at;
            $cobro->save();
        }
        echo "termina3";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cobros', function (Blueprint $table) {
            $table->dropColumn('fecha');
        });
    }
}
