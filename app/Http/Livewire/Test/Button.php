<?php

namespace App\Http\Livewire\Test;

use Livewire\Component;

class Button extends Component
{
    public $selected = false;
    public $btnText = 'Agregar';
    public $course;

    public function mount(\App\Course $course)
    {
        $this->course = $course;

        if (session('courses')) {
            foreach (session('courses') as $key => $value) {
                if($value == $this->course->id){
                    $this->selected = !$this->selected;
                    $this->selected? $this->btnText='Quitar':$this->btnText='Agregar';
                }
            }
        }

    }

    public function plus()
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

        
        /*
        if (session('courses')) {
            foreach (session('courses') as $key => $value) {
                if($value == $this->course->id){
                    $aux = session()->pull('courses',[]);
                    if (($key = array_search($this->course->id, $aux)) != false) {
                        unset($aux[$key]);
                        session()->put('courses',$aux);
                        $flag = true;
                        break;
                        $this->selected = false;
                        $this->btnText = 'Añadir';
                    }
                }
            }
            if (!$flag) {
                $this->selected = true;
                $this->btnText = 'Quitar';
                session()->push('courses',$this->course->id);
            }
        }else{
            $this->selected = true;
            $this->btnText = 'Quitar';
            session()->push('courses',$this->course->id);
        }*/
    }
    public function render()
    {
        return view('livewire.test.button');
    }
}
