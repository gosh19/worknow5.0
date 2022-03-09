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
    public $showModal;


    public function mount(\App\Course $course, $showModal =false)
    {
        $this->showModal = $showModal;
        $this->course = $course;
        $this->country = session('country') == null ? 'SD':session('country');

        if (\Request::route()->getName() == 'User.selectCourses') {
            foreach (Auth::user()->courses as $key => $courseUser) {
                if ($courseUser->id == $this->course->id) {
                    $this->selected = true;
                    $this->btnText = 'Quitar';
                }
            }
        }else {
            
            if (session('courses')) {
                foreach (session('courses') as $key => $idCourseSelected) {
                    if ($idCourseSelected == $this->course->id) {
                        $this->selected = true;
                        $this->btnText = 'Quitar';
                    }
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
        $this->btnText='Agregar';
    }


    public function add($isInSelectCourses)
    {
        if($isInSelectCourses){
            if (!Auth::user()->hasCourse($this->course->id)) {
                Auth::user()->courses()->attach($this->course->id);
            }else {
                Auth::user()->courses()->detach($this->course->id);
            }
            $this->btnText='asd';
        }else{

            if ($this->selected) {
                $aux = session()->pull('courses',[]);
                $key = array_search($this->course->id, $aux);
                unset($aux[$key]);
                session()->put('courses',$aux);
                
            }else{
                session()->push('courses',$this->course->id);
            }
            $this->btnText='asd2';
        }
        $this->selected = !$this->selected;
        //$this->selected? $this->btnText='Quitar':$this->btnText='Agregar';

        $this->emit('addCourse', $this->course->id);
        $this->emit('refreshCourseList');
    }
    
    public function render()
    {

        return view('livewire.inscripcion.curso');
        
    }
}
