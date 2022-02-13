<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForoController extends Controller
{
    public function index()
    {
        $posts = \App\Post::where('habilitado',1)->orderBy('updated_at','desc')->take(10)->get();

        $notis = \App\PostNotification::where([['user_id',auth()->user()->id],['visto',0]])->get();
        foreach ($notis as $key => $not) {
            $not->visto = 1;
            $not->save();
        }
        foreach ($posts as $key => $post) {
            $visto = \App\UserPost::firstOrNew(['user_id'=>auth()->id(),'post_id'=>$post->id],['visto',1]);
            $visto->save();
        }

        return view('foro.index',['posts'=> $posts]);
    }

    public function verNoHab()
    {
        $posts = \App\Post::where('habilitado',0)->orderBy('updated_at','desc')->get();

        return view('foro.verNoHab',['posts'=> $posts]);
    }

    public function verNotificaciones()
    {
        $notificaciones = \App\PostNotification::where('user_id',auth()->user()->id)
                                                ->orderBy('updated_at','desc')
                                                ->take(30)
                                                ->get();
                                
        return view('foro.notificaciones',['notificaciones'=> $notificaciones]);
    }
}
