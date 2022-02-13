<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCantCuotasToAdicionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adicionals', function (Blueprint $table) {
            $table->renameColumn('cant_coutas', 'cant_cuotas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adicionals', function (Blueprint $table) {
            $table->renameColumn( 'cant_cuotas', 'cant_coutas');
        });
    }
}
