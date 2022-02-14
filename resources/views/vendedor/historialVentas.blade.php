@extends('layouts.app')

@section('content')

    @livewire('vendedor.index', ['user' => $user], key($user->id))
@endsection