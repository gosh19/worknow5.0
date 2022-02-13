<?php

namespace App\Http\Livewire\Objetivo;

use Livewire\Component;

use App\ObjetivoCustom;

class Item extends Component
{
    public $edit = false;
    public $custom;
    public $name;
    public $premio;
    public $objetivo;
    public $desde;
    public $hasta;

    public function mount(ObjetivoCustom $custom)
    {
        $this->custom = $custom;

        $this->name = $custom->name;
        $this->premio = $custom->premio;
        $this->objetivo = $custom->objetivo;
        $this->desde = $custom->desde;
        $this->hasta = $custom->hasta;
    }

    public function updateData()
    {
        $this->custom->name = $this->name;
        $this->custom->premio = $this->premio;
        $this->custom->objetivo = $this->objetivo;
        $this->custom->desde = $this->desde;
        $this->custom->hasta = $this->hasta;

        $this->custom->save();

        $this->edit = false;
    }

    public function render()
    {
        return view('livewire.objetivo.item');
    }
}
