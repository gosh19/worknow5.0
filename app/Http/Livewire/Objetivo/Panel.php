<?php

namespace App\Http\Livewire\Objetivo;

use Livewire\Component;

use Carbon\Carbon;
use App\ObjetivoCustom;

class Panel extends Component
{
    public $name ='';
    public $objetivo = 0;
    public $premio = 0;
    public $desde;
    public $hasta;

    public $customs = [];

    public $loading = false;

    protected $listeners = ['updateList'];

    public function mount()
    {
        $this->desde = date_format(Carbon::now(),'Y-m-d');
        $this->hasta = date_format(Carbon::tomorrow(),'Y-m-d'); 
        $this->customs = ObjetivoCustom::orderBy('id','desc')->get();
    }

    public function crearObjetivo()
    {
        $this->loading = true;
        
        $objetivo = new ObjetivoCustom;

        $objetivo->name = $this->name;
        $objetivo->objetivo = $this->objetivo;
        $objetivo->premio = $this->premio;
        $objetivo->desde = $this->desde;
        $objetivo->hasta = $this->hasta;

        $objetivo->save();
        $this->name =null;
        $this->objetivo =null;
        $this->premio =null;
        $this->desde = date_format(Carbon::now(),'Y-m-d');
        $this->hasta = date_format(Carbon::tomorrow(),'Y-m-d'); 
        $this->loading = false;

        $this->emit('updateList');
    }

    public function updateList()
    {
        $this->customs = ObjetivoCustom::orderBy('id','desc')->get();
    }

    public function render()
    {
        return view('livewire.objetivo.panel');
    }
}
