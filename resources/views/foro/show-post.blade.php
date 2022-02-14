@extends('layouts.app')

@section('content')
    <div class="container">
        @livewire('foro.post',['post'=> $post])
    </div>
@endsection