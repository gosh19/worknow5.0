@extends('layouts.app')

@section('content')

<table class="table">
    <thead>
        <th scope="row" >ID</th>
        <th scope="row" >Denominacion</th>
        <th scope="row" >---</th>
    </thead>
    <tbody>
        @foreach ($cuentas as $cuenta)   
        <tr>
            <th scope="row" >{{$cuenta->id}}</th>
            <td>{{$cuenta->name}} </td>
            <td><button class="btn btn-danger" disabled="disabled">Eliminar</button></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection