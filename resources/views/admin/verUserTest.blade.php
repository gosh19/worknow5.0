@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <th>Cursos</th>
            <th>Fecha registro</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Pais</th>
            <th>Telefono</th>
        </thead>
        <tbody>
            @foreach ($usersTest as $userTest)
            @if ($userTest->visto)
            <tr class="bg-info" >
                
            @else
            <tr class="bg-success" >    
            @endif
                    <td>
                        <ul>
                            @foreach ($userTest->user->courses as $curso)
                                <li>{{$curso->nombre}} </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{date_format($userTest->created_at, 'd-m-Y')}} </td>
                    <td><a style="color:#FFF; font-weight: bold" href="/modificarAlumno?id={{$userTest->user_id}}">{{$userTest->user->email}}</a></td>
                    <td> {{$userTest->user->name}}</td>
                    <td>{{@$userTest->user->datosUser->country ?? 'sin cargar'}}</td>
                    <td>{{@$userTest->user->datosUser->telefono ?? 'sin cargar'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection