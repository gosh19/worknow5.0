<?php

namespace App\Mail;

use Illuminate\Http\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CadenaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Contenido nuevo";

    private $unity;
    private $curso;
    private $nombre;
    private $texto;
    private $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->unity = \App\Unity::find($request->unidad_id);
        $this->curso = \App\Course::find($request->curso_id);
        $this->texto = $request->texto;
        $this->url = 'https://worknow-cursos.com/Unidad?id='.$this->unity->id;
        $this->nombre = $request->nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mail-contenido-nuevo',[
            'nombre' => $this->nombre,
            'unity' => $this->unity, 
            'curso' => $this->curso,
            'texto' => $this->texto,
            'url' => $this->url,
        ]);
    }
}
