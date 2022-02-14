@extends('layouts.app')

@section('content')
    <input type="text" id="user" value="{{$user ?? null}}" hidden >
    <div id="app-cobranza" >Loading...</div>
@endsection