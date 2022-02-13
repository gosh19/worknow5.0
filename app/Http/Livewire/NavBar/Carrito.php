<?php

namespace App\Http\Livewire\NavBar;

use Livewire\Component;

class Carrito extends Component
{
    public $courses = [];
    public $isModalOpen = false;
    public $country;

    public $listeners = ['refreshCourseList' => 'refreshList'];

    public function mount()
    {
        $this->refreshList();
        $this->country = session('country') ? session('country'):'UKN';
    }

    public function refreshList()
    {
        $this->courses = [];
        if (session('courses')) {
            foreach (session('courses') as $key => $value) {
                $this->courses[] = \App\Course::find($value);
            }
        }
    }

    public function remove($key)
    {
        $courseId = $this->courses[$key]['id'];
        if (isset($this->courses[$key])) {
            # code...
            unset($this->courses[$key]);
            session()->forget('courses');
            $aux = [];
            foreach ($this->courses as $j => $course) {
                $aux[]= $course['id'];
            }
            session()->put('courses',$aux);
            $this->emit('removeCourse-'.$courseId);
        }
    }

    public function render()
    {
        return view('livewire.nav-bar.carrito');
    }
}
