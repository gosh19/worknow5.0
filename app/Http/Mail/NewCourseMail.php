<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCourseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Nuevo curso agregado - Work Now Cursos";

    protected $user;
    protected $course;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\User $user, \App\Course $course)
    {
        $this->user = $user;
        $this->course = $course;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mail-nuevo-curso',['user'=> $this->user,'course' => $this->course]);
    }
}
