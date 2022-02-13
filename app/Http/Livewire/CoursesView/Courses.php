<?php

namespace App\Http\Livewire\CoursesView;

use Livewire\Component;

class Courses extends Component
{
    public $courses = [];
    public $categoria = '';

    public $listeners = ['selectCategoria' => 'changeCategoria'];

    public function mount(\App\Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->courses = $categoria->courses;        
    }

    public function changeCategoria($id)
    {
        $this->categoria = \App\Categoria::find($id);
        $this->courses = $this->categoria->courses; 
    }

    public function render()
    {
        return view('livewire.courses-view.courses');
    }
}
