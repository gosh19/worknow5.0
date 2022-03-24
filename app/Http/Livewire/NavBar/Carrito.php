<?php

namespace App\Http\Livewire\NavBar;

use Livewire\Component;

class Carrito extends Component
{
    public $courses = [];
    public $isModalOpen = false;
    public $country;
    public $prices = [];

    public $listeners = ['refreshCourseList' => 'refreshList'];

    public function mount()
    {
        $this->country = session('country') ? session('country'):'UKN';
        $this->refreshList();
    }

    public function refreshList()
    {
        $this->prices = [];
        $this->courses = [];
        if (session('courses')) {
            foreach (session('courses') as $key => $value) {

                    $this->courses[$key] = \App\Course::find($value);
                    $this->prices[$key] = $this->courses[$key]->info->getPrecio($this->country);
            }
        }
    }

    public function remove($key)
    {
        if (isset($this->courses[$key])) {
            $courseId = $this->courses[$key]['id'];
            
            unset($this->courses[$key]);
            unset($this->prices[$key]);
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
