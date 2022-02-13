<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowAnuncioAgain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'showanunciofb:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambia el "visto" de la tabla anuncios a 0 de determinados users';

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
        $hoy->day = $hoy->day - 15;
        $anuncios = \App\Anuncio::whereDate('created_at',$hoy)->get();

        foreach ($anuncios as $key => $an) {
            $an->visto = 0;
            $an->save();
            echo $an->user_id."\n";
        }
    }
}
