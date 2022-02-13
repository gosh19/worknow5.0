<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\MassiveMail;

class EchoTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'echotest:run';

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
        $users = \App\User::where([ 
                                ['rol', 'alumno'],
                                ['habilitado', 1],
                                ['tipo_pago','!=', 'test']
                                ])->get();
        foreach ($users as $a ) {
            try {
                Mail::to($a->email)->queue(new MassiveMail($a->name));
                echo $a->email.'  --- OK';
                echo "\n";

            } catch (\Throwable $th) {
                //throw $th;
                echo $a->email.'  --- ERROR';
                echo "\n";
                echo $th->getMessage();
                echo "\n";
            break;
            }
        }
    }
}
