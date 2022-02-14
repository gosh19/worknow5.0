@extends('layouts.app')

@section('content')
<a class="btn btn-primary ml-3" href="{{route('Practice.showPractices',['Course'=> $practice->course])}}">Volver</a>
<div class="container">
    @include('practice.show-practice',['practice' => $practice])
    @include('practice.form-envio-msj',['practice'=>$practice,'user_id'=> Auth::user()->id])
    @include('practice.conversation',['practice'=>$practice,'user_id'=> Auth::user()->id])
</div>

@endsection