@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Monto</th>
                    <th scope="col">url</th>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Estado</th>
                    <th scope="col">---</th>
                </tr>
            </thead>
            <tbody>
                @if (count($cupones) == 0)
                    <div class="alert alert-warning">
                        No hay cupones creados, presiona 
                        <a class="btn btn-success" href={{ route('Cupon.create')}}>Aqui</a> 
                        para crear uno
                    </div>
                @else
                    
                    @foreach ($cupones as $cupon)
                        @if ($cupon->habilitado == 1)
                        <tr class="bg-success">  
                        @else
                        <tr class="bg-danger">
                        @endif
                        
                            <th scope="row">{{$cupon->id}}</th>
                            <th>{{$cupon->name}}</th>
                            <th>{{$cupon->monto}}</th>
                            <th><a href={{$cupon->url}}>Link</a></th>
                            <th>{{$cupon->vendedor == null ? 'General': $cupon->vendedora->name}}</th>
                            <th>
                                <a href="modificar-hab-cupon/{{$cupon->id}}">
                                @if ($cupon->habilitado == 1)
                                    <button class="btn btn-danger">Desactivar</button>  
                                @else
                                    <button class="btn btn-success">Activar</button>
                                @endif
                                </a>
                            </th>
                            <th><a href="{{route('Cupon.edit',['Cupon' => $cupon])}}"><button class="btn btn-primary">Editar</button></a></th>
                        </tr>
                    @endforeach
                @endif

            </tbody>

        </table>
    </div>
@switch(session('msg'))
    @case('update')
        <script>
            swal('Great!', 'Cupon modificado con exito', 'success');
        </script>
        @break
    @case('delete')
        <script>
            swal('Great!', 'Cupon eliminado con exito', 'success');
        </script>
        @break
    @default
        
@endswitch

@endsection