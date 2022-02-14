@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <th>Curso</th>
            <th>Unidad</th>
            <th>Titulo</th>
            <th>Sub-titulo</th>
            <th>Link</th>
            <th>Action 1</th>
            <th>Action 2</th>
        </thead>
        <tbody>
            @foreach ($videos as $video)
                <tr>
                    <td>{{$video->unity->courses[0]->nombre}} </td>
                    <td>{{$video->unity->nombre}} </td>
                    <td>{{$video->titulo}} </td>
                    <td>{{$video->subtitulo}} </td>
                    <td> <a href="{{$video->html}}">Ver</a></td>
                    <td><a class="btn btn-primary" href="{{route('VideosYT.edit',['VideosYT' => $video])}}">Editar</a></td>
                    <td><a onclick="javascript:return confirm('Are You Confirm Deletion');" class="btn btn-danger" href="{{route('VideosYT.destroyy',['id' => $video->id])}}">Eliminar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection