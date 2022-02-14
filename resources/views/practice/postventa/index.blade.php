@extends('layouts.app')

@section('content')
<a class="btn btn-primary ml-3 fixed" href="/postventa">Volver</a>
<div class="container">
    @include('practice.show-practice',['practice'=> $practice])
    @include('practice.form-envio-msj',['practice'=>$practice,'user_id'=>$user_id])
    @include('practice.conversation',['practice'=>$practice,'user_id'=>$user_id])

</div>
@endsection