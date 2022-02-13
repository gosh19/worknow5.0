<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\InfoFac;

class InhabilitarEfectivos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inhabefectivo:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $hoy = Carbon::now();

        $hoy->day = $hoy->day - 5;
        try {
            
            $infoFacs = InfoFac::whereDate('fecha_sig_cobro','=' , date_format($hoy, 'Y-m-d'))
                                ->where('cobrable',1)
                                ->with('user')
                                ->get();
            $flag = true;
            foreach ($infoFacs as $index => $info ) {               
                if ($info->user->tipo_pago == "efectivo") {
                    $info->user->habilitado = 0;
                    $info->user->save();
                    echo $info->user->name."\n";
                    $flag = false;
                }
            }
            if ($flag ) {
                echo "No hay nadie para inhabilitar";
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }
}
