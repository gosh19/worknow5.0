<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function images()
    {
        return $this->belongsToMany('App\ResourceForo');
    }

    public function comments()
    {
        return $this->hasMany('App\PostComment')->orderBy('id','desc')->take(4);
    }

    public function userLike($user_id)
    {
        $like = \App\PostLike::where([['user_id',$user_id],['post_id', $this->id]])->first();

        if ($like != null) {
            return true;
        }

        return false;
    }
    public function likes()
    {
        return $this->hasMany('App\PostLike');
    }
}
