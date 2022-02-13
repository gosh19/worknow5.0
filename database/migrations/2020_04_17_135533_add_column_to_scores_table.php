<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->float('nota_numerica')->after('nota')->nullable();
        });

        $scores = \App\Score::all();
        foreach ($scores as $score ) {
            if ($score->nota == "aprobado") {
                $score->nota_numerica = 10;
            }else{
                $score->nota_numerica = 0;
            }

            $score->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('nota_numerica');
        });

    }
}
