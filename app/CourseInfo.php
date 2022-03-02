<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseInfo extends Model
{
    public $primaryKey = 'course_id';
    protected $fillable = [
        'course_id', 'peso', 'dolar', 'discount', 'on',
    ];

    protected function valor($value)
    {
        if (($this->on) && ($this->discount != null)) {
            return ($value - $value*($this->discount/100));
        }
        return $value;
    }

    public function getPrecio($country)
    {
        if ($this->free) {
           return 0;
        }

        if (($country == 'AR')||($country == 'ARG')) {
            if ($this->peso != null) {
                return $this->valor($this->peso);
            }else {
                return 1989;
            }
        }else {
            $valor ;
            if ($this->dolar != null) {
                $valor = $this->valor($this->dolar);
            }else {
                $valor = 23;
            }

            switch ($country) {
                case 'CL':
                    $valor = $valor * 806.93;
                    break;
                case 'UY':
                    $valor = $valor * 42.54;
                    break;
                default:
                    # code...
                    break;
            }

/*
            if ($country == 'PY') {

                if (session('conversion')) {

                    $valor = $valor*(session('conversion') ?? 7045 );
                }else{
                    $valor =( $valor * 7045);
                }
            }else if ($country ==  'CL') {
                if (session('conversion')) {

                    $valor = $valor*(session('conversion') ?? 808.92 );
                }else{
                    $valor =( $valor * 808.92);
                }
            }*/
            return $valor;
        }
    }
}
