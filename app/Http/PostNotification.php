<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class PostNotification extends Model
{

    protected $fillable = [
        'user_id','sender','post_id','case'
    ];
    /**
     * carga una notificacion
     * @receiver id del q recibira la notificacion
     * @case que se hizo
     * @post id del posteo al q le va la noti
     */
    public static function sendNotification(int $receiver, string $case, int $post)
    {

        \App\PostNotification::updateOrCreate(
            ['user_id'=> $receiver, 'sender'=>auth()->id(),'post_id'=> $post, 'case'=> $case]
        );

        $p = \App\Post::find($post);

        foreach ($p->comments as $j => $value) {
            \App\PostNotification::updateOrCreate(
                ['user_id'=> $value['user_id'], 'sender'=>auth()->id(), 'post_id'=> $post, 'case'=> $case]
            );
        }
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'sender', 'id');
    }
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    
}
