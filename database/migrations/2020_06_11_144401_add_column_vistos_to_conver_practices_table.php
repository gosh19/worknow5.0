<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnVistosToConverPracticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conver_practices', function (Blueprint $table) {
            $table->boolean('admin')->nullable()->default(false)->after('open');
            $table->boolean('alumno')->nullable()->default(true)->after('open');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conver_practices', function (Blueprint $table) {
            //
        });
    }
}
