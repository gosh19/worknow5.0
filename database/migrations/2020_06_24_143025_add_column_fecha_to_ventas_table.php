<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFechaToVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->date('fecha')->nullable()->after('vendedor');
        });
        $ventas = \App\Venta::all();

        foreach ($ventas as $key => $venta) {
            $venta->fecha = date_format($venta->updated_at,'Y-m-d');
            $venta->save();
            echo "Registro $key modificado\n"; 
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('fecha');
        });
    }
}
