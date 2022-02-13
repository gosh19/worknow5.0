<?php

namespace App\Http\Livewire\CoursesView;

use Livewire\Component;

class Index extends Component
{
    public $categorias = [];
    public $selectedCategoria;
    public $showModal = false;
    public $selectedCourse;
    public $btnText = "Añadir al carrito";
    public $isInCarrito = false;
    public $courseList = [];
    public $country;

    public $listeners = ['selectCategoria','selectCourse'];

    public function mount($categorias){
        $this->categorias = $categorias;
        $this->selectedCategoria = $categorias[0]; //PONGA LA PRIMER CATEGORIA PARA INICIALIZAR LA VARIABLE
        
        $this->updateCourseList();
        
        $this->country = session('country') ?? 'UKN';
    }

    public function selectCategoria($id)
    {
        $this->selectedCategoria = \App\Categoria::find($id);
    }

    public function updateCourseList()
    {
        if (session('courses')) {
            foreach (session('courses') as $key => $id) {
                $this->courseList[] = \App\Course::find($id);
            }
        }
    }

    public function selectCourse(\App\Course $course)
    {   
        $this->showModal = true;
        $this->selectedCourse = $course;
        $this->isInCarrito = false;
        $this->btnText = 'Añadir al carrito';

        if (session('courses')) {
            foreach (session('courses') as $key => $selected) {
                if ($selected == $course->id) {
                    $this->isInCarrito = true;
                    $this->btnText = 'Quitar del carrito';
                }
            }
        }
    }

    public function add($id)
    {
        if ($this->isInCarrito) {
            $aux = session()->pull('courses',[]);
            $key = array_search($id, $aux);
            unset($aux[$key]);
            session()->put('courses',$aux);

            $this->btnText = "Añadir al carrito";
            $this->isInCarrito = false;
        }else{
            $this->isInCarrito = true;
            $this->btnText = 'Quitar del carrito';
            session()->push('courses',$id);
        }
    }


    public function render()
    {
        return view('livewire.courses-view.index');
    }
}
