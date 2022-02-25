@extends('layouts.app')

@section('corregidos')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Fecha de entrega</th>
                <th scope="col">Link del Trabajo Práctico</th>
                <th scope="col">Nota</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($scores); $i++)
                @if (!$scores[$i]['scores']->isEmpty())
                    @for ($x = 0; $x < count($scores[$i]['scores']); $x++)
                        <tr>
                            <th scope="row">{{ $i + 1 }}</th>
                            <td>{{ $scores[$i]['scores'][$x]['user_id'] }}</td>
                            <td>{{ $scores[$i]['scores'][$x]['created_at'] }}</td>
                            <td><a href="{{ route('Tpresuelto.download', ['url' => $scores[$i]['url']]) }}">
                                    {{ $scores[$i]['url'] }}</a></td>
                            @if ($scores[$i]['scores'][$x]['nota'] == 'aprobado')
                                <td>
                                    <div class="alert alert-success"><strong>{{ $scores[$i]['scores'][$x]['nota'] }}</strong>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="alert alert-danger">{{ $scores[$i]['scores'][$x]['nota'] }}</div>
                                </td>
                            @endif
                        </tr>
                    @endfor
                @endif
            @endfor
        </tbody>
    </table>

    <div class="text-center"><a href="/postventa" class="btn btn-danger">Volver</a></div>
@endsection
