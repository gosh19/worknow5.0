@extends('layouts.app-alt')

@section('content')
<div class="min-h-screen lg:min-h-full ">
    @livewire('courses-view.index', ['categorias' => $categorias])
</div>

@endsection