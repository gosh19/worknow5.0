<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;

        $post->user_id = Auth::id();
        $post->text = $request->text;

        $post->save();

        if ($request->img != null) {
            # code...
            foreach ($request->img as $key => $img) {
                $res = new \App\ResourceForo;

                $file = $img;
                $name = $file->store('imgForo/'.Auth::user()->name."/".$post->id, 'public');

                $res->url = '/storage/'.$name;

                $res->save();

                $post->images()->attach($res->id);
            }
        }

        return redirect()->back();
    }

    public function modHab(Post $Post)
    {
        $Post->habilitado = !$Post->habilitado;

        $Post->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $Post)
    {
        $noti = \App\PostNotification::where([['user_id',auth()->id()],['post_id',$Post->id],['visto',0]])->first();

        if ($noti != null) {
            $noti->visto = 1;
            $noti->save();
        }

        return view('foro.show-post',['post'=> $Post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $Post)
    {
        $Post->delete();

        return redirect()->back();
    }
}
