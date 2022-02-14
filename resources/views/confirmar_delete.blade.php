@extends('layouts.app')

@section('confirmar_delete')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-10">
              <div class="card">
                  <div class="card-header text-center"><h3><strong>Vas a eliminar éste curso!! </strong></h3></div>
                  <div class="card-body">
                    {{$curso->nombre}}
                  </div>
                  <div class="card-footer text-center">
                    <a href="{{route ('Curso.destroy', ['id' => $curso->id])}}" class="btn btn-info">Estoy seguro !!</a>
                    <a href="/desarrollo" class="btn btn-danger">No no quiero eliminarlo</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
