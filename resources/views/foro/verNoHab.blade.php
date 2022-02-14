@extends('layouts.app') 

@section('content')
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Alumno</th>
            <th>Texto</th>
            <th>Imagen 1</th>
            <th>Imagen 2</th>
            <th>Imagen 3</th>
            <th>--</th>
            <th>--</th>
        </thead>
        <tbody>
            @foreach ($posts as $key => $value)
                <tr>
                    <td scope="row">{{$value->id}}</td>
                    <td>{{$value->user->name}}</td>
                    <td>{{$value->text}}</td>
                    @for ($i = 0; $i < 3; $i++)
                        @if (isset($value->images[$i]))
                            <td style="width:200px;"><img src="{{$value->images[$i]->url}}" width="100%"></td>
                        @else
                            <td>Sin cargar</td>
                        @endif
                    @endfor
                    <td><a class="btn btn-success" href="{{route('Post.modHab',['Post'=>$value])}}">Aprobar</a></td>
                    <td><a class="btn btn-danger" onclick="javascript:return confirm('Seguro que desea eliminar el post?')" href="{{route('Post.delete',['Post'=>$value])}}">Eliminar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection