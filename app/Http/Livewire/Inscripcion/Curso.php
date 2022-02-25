<?php

namespace App\Http\Livewire\Inscripcion;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Curso extends Component
{
    public $course;

    public $debug = 0;
    public $selected = false;
    public $cant = 0;
    public $country = '';
    public $btnText = 'Agregar';


    public function mount(\App\Course $course)
    {
        $this->course = $course;
        $this->country = session('country') == null ? 'SD':session('country');

        if (session('courses')) {
            foreach (session('courses') as $key => $idCourseSelected) {
                if ($idCourseSelected == $this->course->id) {
                    $this->selected = true;
                    $this->btnText = 'Quitar';
                }
            }
        }

    }

    protected function getListeners()
    {
        return ['removeCourse-'.$this->course->id => 'removeCourse'];
    }

    public function removeCourse()
    {
        $this->selected = false;
    }


    public function add()
    {
        if ($this->selected) {
            $aux = session()->pull('courses',[]);
            $key = array_search($this->course->id, $aux);
            unset($aux[$key]);
            session()->put('courses',$aux);
            
        }else{
            session()->push('courses',$this->course->id);
        }

        $this->selected = !$this->selected;
        $this->selected? $this->btnText='Quitar':$this->btnText='Agregar';

        $this->emit('addCourse', $this->course->id);
        $this->emit('refreshCourseList');
    }
    
    public function render()
    {

        return view('livewire.inscripcion.curso');
        
    }
}
