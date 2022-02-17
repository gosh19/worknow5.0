<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BloqueoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user = null;
    public $subject = 'IMPORTANTE - Acceso al aula virtual de Work Now Cursos bloqueado';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mail-bloqueo-aula',['user'=> $this->user]);
    }
}
