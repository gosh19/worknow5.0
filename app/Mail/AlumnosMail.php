<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class AlumnosMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Alta Estudiante";
    private $user = [];
    private $case;
    private $nota_numerica;
    private $data = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $case,$data = NULL)
    {
        $this->user = $user;
        $this->case = $case;
        $this->nota_numerica = $data->nota_numerica ?? null;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {  
        switch ($this->case) {
            case 'altaEstudiante':
                $this->subject = "Alta Estudiante";
                return $this->view('mails.mail-alta-alumno-new',['user' => $this->user]);
                break;
            case 'tpAprobado':
                $this->subject = "CORRECCION ACTIVIDADES - INSTITUTO WORK NOW";
                return $this->view('mails.mail-correccion-tp-aprobado',[
                                                                        'user' => $this->user, 
                                                                        'nota' => $this->nota_numerica,
                                                                        'msj' => $this->data->msj,
                                                                         'tp' => $this->data->tp,
                                                                        ]);
                break;
            case 'tpDesaprobado':
                $this->subject = "CORRECCION ACTIVIDADES - INSTITUTO WORK NOW";
                return $this->view('mails.mail-correccion-tp-desaprobado',[
                                                                            'user' => $this->user,
                                                                            'nota' => $this->nota_numerica,
                                                                            'msj' => $this->data->msj,
                                                                            'tp' => $this->data->tp,
                                                                            ]);
                break;
            case 'consultaAvance':
                $this->subject = "¿Como te esta yendo? - INSTITUTO WORK NOW";
                return $this->view('mails.mail-nuevo-alumno',[
                                                                'user' => $this->user,
                                                                ]);
                break;
            case 'recuperoDato':
                $this->subject = "INSTITUTO WORK NOW - Curso de ".$this->user->course->nombre;
                return $this->view('mails.mail-recupero-dato',[
                                                                'user' => $this->user,
                                                                ]);
                break;
            case 'cadenaMail':
                $this->subject = $this->data['subject'];
                return $this->view('mails.mail-cadena-mensaje',[
                                                                'name' => $this->user->name,
                                                                'msj' => $this->data['msj']
                                                                ]);
                break;
            default:
                # code...
                break;
        }
        
    }
}
