@extends('layouts.app')

@section('content')
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">E-mail</th>
      <th scope="col">Tipo</th>
      <th scope="col">Acción</th>

    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
      <tr>
        <th scope="row">{{$user->id}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->tipo_pago}}</td>
        <td><a href="{{ route ('Tp.aprobarTps', ['id' => $user->id])}}" class="btn btn-danger">Habilitar Tp's</a></td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
