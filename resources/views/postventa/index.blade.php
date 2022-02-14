@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card" style="width: 18rem;">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="{{route ('User.create')}}">Crear Alumno</a></li>
            <li class="list-group-item"><a href="{{route ('Curso.index')}}">Ver Cursos</a></li>
            <li class="list-group-item"><a href="{{route ('Tpresuelto.index')}}">Correción de Tp's</a></li>
            <li class="list-group-item">
              <div class="d-flex  justify-content-between" style="height: 25px">
                <a role="button" data-toggle="collapse" href="#collapsePracticas">Correccion practicas</a>
                @if (count($practicas) ?? 0 != 0)
                  <div style="height: 100%" class="d-flex">
                    <img style="height:100%" src={{ asset('img/notification-bell.png') }}>
                    <div 
                      style="height: 30px;width: 30px;border-radius:20px;font-weight:bold;" 
                      class="bg-danger text-center text-white p-1"
                    >
                      {{count($practicas) ?? 0}}
                    </div>
                  </div>
                @endif
              </li>
            </ul>
            <div class="collapse p-2" id="collapsePracticas">
              Practicas sin ver
              <ul class="list-group">

                @foreach ($practicas as $prac)
                  <li class="list-group-item"><a href="{{route('Postventa.showPracticeUser',['Conver'=>$prac,'user_id'=>$prac->user->id])}}">{{$prac->user->name}}</a></li>
                @endforeach
              </ul>
            </div>
        </div>

      </div>
    </div>
  </div>
@endsection
