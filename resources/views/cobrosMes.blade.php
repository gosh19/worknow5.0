@extends('layouts.app')

@section('content')

  <div class="container mt-3">
    <div class="alert alert-info text-center"><strong>Cobros del alumno</strong></div>
  <div class="row">
    <div class="col-md-12">
      <table class="table">
  			<thead>
  				<tr>
  					<th scope="col">Nombre</th>
  					<th scope="col">Tipo</th>
  					<th scope="col">Valor de Cuota</th>
  					<th scope="col">Cantidad de Cuotas</th>
            <th scope="col">Valor Restante</th>
            <th scope="col">Siguiente Cobro</th>
  					<th scope="col">Acciones</th>
  				</tr>
  			</thead>
  			<tbody>
    @for($i = 0; $i < count($estados); $i++)
      <tr>
      <td>{{$estados[$i]['id']}}</td>
      <td>{{$estados[$i]['tipo']}}</td>
      <td>{{$estados[$i]['valor_cuota']}}</td>
      <td>{{$estados[$i]['cant_cuotas']}}</td>
      <td>{{$estados[$i]['valor_restante']}}</td>
      <td>{{$estados[$i]['fecha_siguiente_cobro']}}</td>
      <td><a href="{{route('User.modificarAlumno', ['id' => $estados[$i]['user_id'], 'mes' => $_GET['mes']])}}"class="btn btn-warning">Ver usuario</a></td>
      <td>@php echo '<a class="btn btn-danger" href="/habiztar?id=' . $estados[$i]['user_id'] . '&mes=' . $_GET['mes'] . '">Habiztar</a>';@endphp</td>
    </tr>
    @endfor
        </tbody>
      </table>

    </div>
  </div>
</div>




@endsection
