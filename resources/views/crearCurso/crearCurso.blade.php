@extends('../layouts/app')

@section('content')
  <h1>{{session('id')}}</h1>
  <div class="container">
    <div class="card">
      <div class="card-header">
        Creacion del Curso
      </div>
      <form class="" action="{{route ('Curso.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><input type="text" name="name" value="" placeholder="Nombre Curso..." required></li>
            <li class="list-group-item"><textarea name="descripcion" rows="8" cols="80" placeholder="Descripcion..." required></textarea></li>
            <li class="list-group-item">
              <label for="temario"><h4>Temario: </h4></label>
              <input type="file" id="temario" name="temario" value="" required>
            </li>
            <li class="list-group-item">
              <label for="img"><h4>Imagen: </h4></label>
              <input type="file" id="img" name="imagen" value="" enctype="multipart/form-data" required>
            </li>
            <li class="list-group-item"><input type="submit" name="boton" value="Siguiente" class="btn btn-danger btn-block"></li>
        </ul>
      </form>

    </div>

  </div>
@endsection
