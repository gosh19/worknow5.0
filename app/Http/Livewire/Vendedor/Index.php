<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;
use \App\Vendedor;

class Index extends Component
{
    public Vendedor $vendedor;
    public int $number;
    public $hoy;
    public $ventas = [];
    public $year ;
    public $month;
    public $type = "cerrada";

    public function mount(Vendedor $user)
    {
        $this->vendedor = $user;
        $this->hoy = \Carbon\Carbon::now();
        $this->year = $this->hoy->year;
        $this->month = $this->hoy->month;

        $this->ventas = $this->getVentasMesActual();

    }   

    public function getVentasMesActual()
    {
        $ventas = \App\Venta::where([['vendedor',$this->vendedor->id],['estado','cerrada']])
                            ->whereMonth('fecha',$this->month)
                            ->whereYear('fecha',$this->year)
                            ->orderBy('fecha','desc')
                            ->get();
        return $ventas;
    }

    public function getVentas($type)
    {
        $this->ventas = \App\Venta::where([['vendedor',$this->vendedor->id],['estado',$this->type]])
                            ->whereMonth('fecha',$this->month)
                            ->whereYear('fecha',$this->year)
                            ->get();
    }

    public function changeMonth($month)
    {
        $this->month = $month;
    }

    public function updated()
    {
        $this->getVentas($this->type);
    }

    public function render()
    {
        return view('livewire.vendedor.index');
    }
}
