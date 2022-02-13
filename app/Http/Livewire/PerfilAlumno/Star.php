<?php

namespace App\Http\Livewire\PerfilAlumno;

use Livewire\Component;
use \App\User;


class Star extends Component
{
    public $text = "asd";

    public function updated()
    {
        $this->text="actualiza3";
    }
    public function render()
    {
        return view('livewire.perfil-alumno.star');
    }
}
