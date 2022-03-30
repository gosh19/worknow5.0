<?php

namespace App\Http\Livewire\NavBar;

use Livewire\Component;

class CarritoFlotante extends Component
{
    public $courses = [];
    public $country;

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

                    $this->courses[$key] = $value;
            }
        }
    }
    
    public function render()
    {
        return view('livewire.nav-bar.carrito-flotante');
    }
}
