<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideosYT extends Model
{
    protected $table= 'videos_y_ts';
    protected $fillable = [
      'titulo', 'subtitulo', 'html', 'unity_id'
    ];

    public function unity()
    {
        return $this->belongsTo('App\Unity');
    }
}
