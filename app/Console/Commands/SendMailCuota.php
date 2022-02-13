<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Mail\CuotaAlumnoMail;

use App\InfoFac;

class SendMailCuota extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmailcuota:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de mail de cupon a los que tengan fecha de cobro de hoy';

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
        $hoy->day = $hoy->day + 5;

        $infoFacs = InfoFac::whereDate('fecha_sig_cobro', date_format($hoy, 'Y-m-d'))
                            ->where('cobrable',1)
                            ->with('user')
                            ->get();

        $cupon;

        $flag = true;
        foreach ($infoFacs as $info ) {
            $cupon = \App\Cupon::find(40);
            if ($info->monto_cuota != 1200) {
                $cupon = \App\Cupon::find(32);
            } 
            $fecha = new Carbon($info->fecha_sig_cobro);

            $fecha->day = $fecha->day +10;
            try {
                if (($info->user->tipo_pago == 'efectivo') && ($info->user->habilitado == 1)) {
                    Mail::to($info->user->email)->send(new CuotaAlumnoMail($info->user, $cupon,$fecha));
                    echo $info->user->email."----OK \n";
                    $flag = false;
                }
            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getMessage();
            }
        }

        $hoy = Carbon::now();

        $infoFacs = InfoFac::whereDate('fecha_sig_cobro', date_format($hoy, 'Y-m-d'))
                            ->where('cobrable',1)
                            ->with('user')
                            ->get();
        
        

        

        foreach ($infoFacs as $info ) {
            $cupon = \App\Cupon::find(40);
            if ($info->monto_cuota != 1200) {
                $cupon = \App\Cupon::find(32);
            } 
            $fecha = new Carbon($info->fecha_sig_cobro);

            $fecha->day = $fecha->day +5;
            try {
                if (($info->user->tipo_pago == 'efectivo') && ($info->user->habilitado == 1)) {
                    Mail::to($info->user->email)->send(new CuotaAlumnoMail($info->user, $cupon,$fecha));
                    echo $info->user->email."----OK \n";
                    $flag = false;
                }
            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getMessage();
            }
        }

        if ($flag) {
            echo "No hay nadie para enviar la cuota";
        }
    }
}
