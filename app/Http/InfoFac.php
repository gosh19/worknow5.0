<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoFac extends Model
{
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'user_id', 'monto_cuota', 'fecha_sig_cobro'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
