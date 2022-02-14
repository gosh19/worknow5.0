<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    protected $fillable = [
        'titulo', 'subtitulo', 'url', 'course_id'
    ];

    public function course()
    {
        return $this->hasOne('App\Course');
    }
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    public function vistoUser($id)
    {
        $control = true;
        foreach ($this->users as $key => $user) {
            if ($user->pivot->user_id == $id ) {
                $control = false;
                break;
            }
        }
        if ($control) {
            $this->users()->attach($id);
        }
    }
    /**
     * DEVUELVE TRUE SI EL USUARIO NO VIO LA NOVEDAD
     */
    public function sinVer($id)
    {
        $control = true;
        foreach ($this->users as $key => $user) {
            if ($user->pivot->user_id == $id ) {
                $control = false;
                break;
            }
        }
        return $control;
    }
}
