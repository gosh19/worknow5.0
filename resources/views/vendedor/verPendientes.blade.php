@extends('layouts.app')


@section('content')
<div class="container">

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">E-mail</th>
                <th scope="col">Curso</th>
                <th scope="col">Informativo</th>
                <th scope="col">Cupon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendientes as $pendiente)

            @php
            $url = "/Vendedor/envio-mail?";
            $url .="curso=".$pendiente->course_id;
            $url .="&email=".$pendiente->email;
            $url .="&name=".$pendiente->name;
            @endphp
            <tr>  
                <td scope="row">{{$pendiente->id}}</td>
                <td>{{$pendiente->name}}</td>
                <td>{{$pendiente->email}}</td>
                <td>{{$pendiente->course['nombre']}}</td>
                @php
                    $url .= "&case=informativo";
                @endphp
                @if ($pendiente->informativo == 1)
                
                <td class="bg-success">
                    <a class="btn btn-danger" href={{$url}}>Reenviar</a>
                </td>
                @else
                <td class="bg-danger">
                    <a class="btn btn-success" href={{$url}}>Enviar</a>
                </td>  
                @endif
                @php
                    $url .= "&case=cupon";
                @endphp
                @if ($pendiente->cupon == 1)
                
                <td class="bg-success">
                    <a class="btn btn-danger" href={{$url}}>Reenviar</a>
                </td>
                @else
                <td class="bg-danger">
                    <a class="btn btn-success" href={{$url}}>Enviar</a>
                </td>  
                @endif
            </tr>

            @endforeach
        </tbody>
    </table>.
</div>
@endsection