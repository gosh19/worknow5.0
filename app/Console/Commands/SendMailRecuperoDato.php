<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlumnosMail;

class SendMailRecuperoDato extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmailrecuperodato:run';

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
        $hoy = \Carbon\Carbon::now();
        $hoy->day = $hoy->day -15;
        $users = \App\Pendiente::whereDate('created_at',$hoy)
                                ->get();
        $vencimiento = \Carbon\Carbon::now();
        $vencimiento->day = $vencimiento->day +4;
        $control = true;
        foreach ($users as $key => $value) {
            $data = \App\User::where('email',$value->email)->get();
            if (count($data) == 0) {
                $value->vencimiento = $vencimiento;
                Mail::to($value->email)->send(new AlumnosMail($value,'recuperoDato'));
                echo $value->email." - Enviado\n";
                $control = false;
            }else{

                echo $value->email." - Ya registrado\n";
            }
        }
        if ($control) {
            echo "Ningun dato para recuperar";
        }
    }
}
