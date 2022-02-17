<?php

namespace App\Mail;

use Illuminate\Http\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendedorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Informacion Curso';
    private $email;
    private $curso;
    private $nombre;
    private $case;
    private $url;
    private $country;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->email = $request->email;
        $curso = \App\Course::find($request->curso);
        $curso->nombre = str_replace('Test', '', $curso->nombre);
        $this->curso = $curso;
        $this->nombre = $request->name;
        $this->case = $request->case;
        $this->url = $request->cupon;
        $this->country = $request->country;
        if ($request->case == 'cupon') {
            $this->subject = 'Inscripcion al curso de '.$curso->nombre;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->case) {
            case 'informativo':
                return $this->view('mails.mail-informativo', [
                    'email' => $this->email, 
                    'curso' => $this->curso,
                    'nombre' => $this->nombre,
                    'country' => $this->country,
                ]);
                break;
            case 'cupon':
                return $this->view('mails.mail-cupon-new', [
                    'email' => $this->email, 
                    'curso' => $this->curso,
                    'nombre' => $this->nombre,
                    'url' => $this->url,
                ]);
                break;
            default:
                # code...
                break;
        }
        
    }
}
