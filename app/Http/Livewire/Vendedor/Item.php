<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;

use \App\Venta;


class Item extends Component
{
    public $venta;

    public $puntos;

    public function mount(Venta $venta)
    {
        $this->venta = $venta;

        $this->puntos = $this->venta->valor();
    }

    public function render()
    {
        return view('livewire.vendedor.item');
    }
}
