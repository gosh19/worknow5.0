<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    protected $fillable = [
        'user_id','post_id','visto'
    ];


    public static function newPosts()
    {
        $posts = \App\Post::where('habilitado',1)->get();
        $cant = 0;
        foreach ($posts as $key => $post) {
            $visto = \App\UserPost::where([['user_id',auth()->id()],['post_id',$post->id]])->first();
            if ($visto == null) {
                $cant++;
            }
        }

        return $cant;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
