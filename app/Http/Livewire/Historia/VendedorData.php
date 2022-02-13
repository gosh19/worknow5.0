<?php

namespace App\Http\Livewire\Historia;

use Livewire\Component;
use \App\Vendedor;


class VendedorData extends Component
{
    public $name;
    public $ventas = [];
    public $cant = [];
    public $cantCountry = [];
    public $cantCursos = [];

    public function mount(Vendedor $vendedor, $ventas)
    {
        $this->name=$vendedor->name;
        $this->ventas = $ventas;
        $this->cant = $this->contarTipo();
        $this->cantCountry = $this->contarCountry();
        $this->cantCursos= $this->contarCursos();
    }

    private function contarTipo()
    {
        $cant = [];
        foreach ($this->ventas as $i => $venta) {
            if (count($cant) == 0) {
                $cant[] = ['type'=> $venta->datosAlumno->tipo_pago, 'cant'=> 1];
            }else{
                $flag = true;

                foreach ($cant as $key => $value) {
                   if ($value['type'] == $venta->datosAlumno->tipo_pago) {
                       $cant[$key]['cant'] += 1;
                       $flag = false;
                       break;
                   }
                    
                }
                if ($flag) {
                    $cant[] = ['type'=> $venta->datosAlumno->tipo_pago, 'cant'=> 1];
                }
            }
        }
        return $cant;
    }
    private function contarCountry()
    {
        $cant = [];
        $country = "N/C";
        foreach ($this->ventas as $i => $venta) {
            if ($venta->datosUser != null) {
                $country = $venta->datosUser->country;
            }
            if (count($cant) == 0) {
                $cant[] = ['country'=> $country, 'cant'=> 1];
            }else{
                $flag = true;

                foreach ($cant as $key => $value) {
                    $country = $country == "AR"? "ARG":$country;
                   if ($value['country'] == $country) {
                       $cant[$key]['cant'] += 1;
                       $flag = false;
                       break;
                   }
                    
                }
                if ($flag) {
                    $cant[] = ['country' => $country, 'cant'=> 1];
                }
            }
        }
        return $cant;


    }

    private function contarCursos()
    {
        $cant = [];
        foreach ($this->ventas as $i => $venta) {
            foreach ($venta->datosAlumno->courses as $curso) {
                if (count($cant) == 0) {
                    $cant[] = ['curso'=> $curso->nombre, 'cant'=> 1];
                }else{
                    $flag = true;

                    foreach ($cant as $key => $value) {
                        
                        if ($value['curso'] == $curso->nombre) {
                            $cant[$key]['cant'] += 1;
                            $flag = false;
                            break 2;
                        }
                    }
                    if ($flag) {
                        $cant[] = ['curso' => $curso->nombre, 'cant'=> 1];
                    }
                }
            }
        }
        return $cant;


    }
    public function render()
    {
        return view('livewire.historia.vendedor-data');
    }
}
