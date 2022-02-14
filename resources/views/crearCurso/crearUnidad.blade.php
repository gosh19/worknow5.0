@extends('../layouts/app')

@section('content')

  @if(session()->has('alert'))
    <script>
        swal("Unidad Creada con éxito", "La unidad se agrego al curso correctamente!", "success");
    </script>
  @endif

  @if (@$error == true)
    <div class="alert alert-danger text-center" role="alert">
      DEBE SELECCIONAR AL MENOS UN CURSO
    </div>
  @endif

  <div class="container">
    <form class="" action="{{route ('Unidad.store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              Crear Unidad
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Nombre Unidad:</span>
                  </div>
                  <input type="text" name="name" class="form-control" id="basic-url" aria-describedby="basic-addon3" required>
                </div>
              </li>
              <li class="list-group-item">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Descripcion</span>
                  </div>
                  <textarea name="descripcion" class="form-control" aria-label="With textarea" rows="8" required></textarea>
                </div>
              </li>

              <li class="list-group-item">
                <div class="input-group">
                  <div id="ModulosUnidad">Cargando...<div>
                </div>
              </li>
              <li class="list-group-item"><input type="submit" name="boton" value="Crear otra unidad" class="btn btn-primary "></li>
              <li class="list-group-item"><input type="submit" name="boton" value="Terminar" class="btn btn-danger "></li>
            </ul>

          </div>
        </div>
        <div class="col">
          <div class="card mb-3">
            <div class="card-header">
              Cursos a los que pertenece
            </div>

            @include('layouts.checkboxCursos')

          </div>
          <div class="card ">
            <div class="card-header">
              Cargar Tps
            </div>
            <ul class="list-group- list-group-flush">
              <li class="list-group-item">
                <div class="input-group mb-3">
                  <div class="input-group">
                    <div id="TpsUnidad">Cargando...<div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection
