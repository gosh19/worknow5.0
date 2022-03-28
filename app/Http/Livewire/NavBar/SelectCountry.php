<?php

namespace App\Http\Livewire\NavBar;

use Livewire\Component;

class SelectCountry extends Component
{
    public $countries = ['AR' => 'img/flags/arg.gif',
                        'CL' => 'img/flags/cl.png',
                        'UY' => 'img/flags/uy.png'];
    public $debug = '';

    public $selected;

    public function mount()
    {
        $this->selected = session('country') !== null ? session('country'):'AR' ;
    }
    
    public function changeCountry($selected)
    {
        $this->selected = $selected;
        session()->forget('country');
        session(['country'=>$selected]);
    }
    public function render()
    {
        return view('livewire.nav-bar.select-country');
    }
}
