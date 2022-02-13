<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTipoToCourseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_user', function (Blueprint $table) {
            $table->id()->before('course_id');
            $table->string('type')->nullable()->default('test')->after('user_id');
            $table->integer('unities')->unsigned()->nullable()->default(1)->after('user_id');
        });

        $users = \App\User::all();
        ini_set('max_execution_time', 1800);
        foreach ($users as $key => $user) {
            $unities = $user->unities_habilitadas;
            $type = $user->tipo_pago;
            
            foreach ($user->courses as $i => $course) {
            $course->pivot->unities = $unities;
            $course->pivot->type = $type;
            $course->pivot->save();
            }
            echo "$key TErminado \n";
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_user', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('unities');
        });
    }
}
