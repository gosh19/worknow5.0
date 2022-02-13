<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Carbon\Carbon;

class CuotaAlumnoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $fechaCierre; 
    protected $url;

    public $subject = "Cuota Work Now Cursos";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $cupon, $fecha)
    {
        $this->user = $user;

        $this->fechaCierre = $fecha;
        $this->url = $cupon->url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mail-cuota', [
                                                'user' => $this->user, 
                                                'fecha' => $this->fechaCierre,
                                                'url' => $this->url,
                                                ]);
    }
}
