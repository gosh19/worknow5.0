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

            if ($country == 'PY') {

                if (session('conversion')) {

                    $valor = $valor*(session('conversion') ?? 7045 );
                }else{
                    $valor =( $valor * 7045);
                }
            }
            return $valor;
        }
    }
}
