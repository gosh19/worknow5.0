<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlumnosMail;


class SendMailAvance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmailavance:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de mail para alumnos nuevos';

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
        $hoy->day = $hoy->day -10;
        $users = \App\User::whereDate('created_at',$hoy)
                            ->where([['habilitado',1],['tipo_pago','<>','test']])
                            ->get();
        $cant = 0;
        foreach ($users as $key => $value) {
            Mail::to($value->email)->send(new AlumnosMail($value,'consultaAvance'));
            $cant++;
        }

        echo "Se enviaron ".$cant." correos de consulta de avance exitosamente";
    }
}
