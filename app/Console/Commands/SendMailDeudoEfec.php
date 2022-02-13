<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeudorEfectivoMail;

class SendMailDeudoEfec extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmaildeudaefectivo:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia el correo de aviso de deuda con boton de wpp';

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
        
        $infoFacs = \App\InfoFac::whereDate('fecha_sig_cobro', date_format($hoy, 'Y-m-d'))
                            ->with('user')
                            ->get();
        
        foreach ($infoFacs as  $info) {
            if (($info->user->tipo_pago == "efectivo") && (!$info->user->habilitado)) {
                echo $info->user->email." - ".$info->fecha_sig_cobro."\n";
                Mail::to($info->user->email)->send(new DeudorEfectivoMail($info->user));
            }
        }
    }
}
