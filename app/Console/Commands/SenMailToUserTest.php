<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Mail\RetencionMail;

use App\User;
use Carbon\Carbon;

class SenMailToUserTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmailtotest:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pasados los dias del ARRAY days envia un cupon de pago a los user test';

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
        $days = [2,15,25]; //CANTIDAD DE DIAS DESDE LA INSCRIPCION HASTA EL ENVIO DEL MAIL

        for ($i=0; $i < count($days); $i++) { 
        
            $fecha = Carbon::now();

            $fecha->day =  $fecha->day-$days[$i];

            $users = User::whereDate('created_at' ,date_format($fecha, 'Y-m-d'))
                            ->where('tipo_pago','test')
                            ->get();

            if (count($users) == 0) {
                echo "No hay nadie para enviar el mail RETENCION ".$i."         \n";
                return 0;
            }
            foreach ($users as $test ) {
                try {
                    Mail::to($test->email)->queue(new RetencionMail($test,$i));
                    
                    echo $test->email." ---- RETENCION ".$i."         \n";
                } catch (\Throwable $th) {
                    echo $test->email." ---- ERROR ".$i."         \n";
                }   
            }
            
        }
    }
}
