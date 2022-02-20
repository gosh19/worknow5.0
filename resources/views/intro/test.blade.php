@extends('layouts.app-alt')

@section('content')
    <div >
        @foreach ($courses as $key => $course)
            @livewire('test.button',['course' => $course],key($i))
        @endforeach
    </div>
@endsection