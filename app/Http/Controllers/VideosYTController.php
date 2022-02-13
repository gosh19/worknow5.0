<?php

namespace App\Http\Controllers;

use App\VideosYT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideosYTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = VideosYT::all();

        return view('youtube.ver-todos-vt',['videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('youtube.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //return $request;
        VideosYT::create([
          'titulo' => $request->titulo,
          'subtitulo' => $request->subtitulo,
          'html' => $request->html,
          'unity_id' => $request->unidad_id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideosYT  $videosYT
     * @return \Illuminate\Http\Response
     */
    public function show(VideosYT $videosYT)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideosYT  $videosYT
     * @return \Illuminate\Http\Response
     */
    public function edit(VideosYT $VideosYT)
    {
        return view('youtube.edit-video-yt',['video' => $VideosYT]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideosYT  $videosYT
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $video = VideosYT::find($request->id);

        $video->titulo = $request->titulo;
        $video->subtitulo = $request->subtitulo;
        $video->html = $request->url;

        $video->save();
        return redirect()->route('VideosYT.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideosYT  $videosYT
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = VideosYT::find($id);

        $video->delete();

        return redirect()->back();
    }
}
