<?php

namespace App\Http\Livewire\CoursesView;

use Livewire\Component;

class Categorias extends Component
{
    public $categorias =[];
    
    public function mount($categorias)
    {
        $this->categorias = $categorias;
    }

    public function render()
    {
        return view('livewire.courses-view.categorias');
    }
}
