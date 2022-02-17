<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RetencionMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $case;

    public $subject = 'Work Now | Capacitate con nosotros';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\User $user, $case)
    {
        $this->user = $user;
        $this->case = $case;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mail-retencion-'.$this->case,['user'=> $this->user]);  
    }
}
