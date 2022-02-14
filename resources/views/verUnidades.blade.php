@extends('layouts.app')


@section('desarrollo')

<div class="container">

  @for($i = 0; $i< count($unidades); $i++)
    <div class="card">
      <div class="card-header">
        <strong>{{$unidades[$i]['nombre']}}</strong>
      </div>
        @for($x = 0; $x < count($unidades[$i]['unities']); $x++)
          <div class="card-body">
            <strong>#</strong> {{$unidades[$i]['unities'][$x]['nombre']}}<a class="btn btn-danger btn-sm" href="{{ route('Unidad.verEditar',['id'=>$unidades[$i]['unities'][$x]['id']])}}">Editar </a>
          </div>
       @endfor
     </div>
   @endfor
 </div>

@endsection
