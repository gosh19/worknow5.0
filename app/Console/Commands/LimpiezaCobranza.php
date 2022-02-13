<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LimpiezaCobranza extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleantableinfofac:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'limpieza de la mugre de la bd de infofac';

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
        
        $users = \App\User::all();

        foreach ($users as $key => $user) {

            $cant = 0;
            if ($user->infoFac != null) {
                foreach ($user->cobros as $cobro) {
                    $cant = $cant + $cobro->cant_cuotas;
                }
                if (($cant >= $user->infoFac->cant_cuotas) && ($user->infoFac->cobrable == 1)) {
                    echo $user->name.' --  Cuotas cobradas = '.$cant."\n";
                    $user->infoFac->cobrable = 0;
                    $user->infoFac->save();
                }
            }
        }

    }
}
