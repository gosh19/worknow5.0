@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead class="bg-blue-500">
            <th scope="row">Curso</th>
            <th scope="row">Temario</th>
            <th scope="row">Peso</th>
            <th scope="row">Dolar</th>
            <th scope="row">Guarani</th>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td class="text-md font-bold">{{$course->nombre}}</td>
                    <td><a target="_blanck" href="{{$course->url_temario}}">Ver temario</a></td>
                    <td>ARS$ {{$course->info != null ? number_format($course->info->getPrecio('AR'),2,',','.'):1989}}</td>
                    <td>USD$ {{$course->info != null ? number_format($course->info->getPrecio('SD'),2,',','.'):23}}</td>
                    <td>PYG$ {{$course->info != null ? number_format(($course->info->getPrecio('SD')*7045),2,',','.'):number_format((23*7045),2,',','.')}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

