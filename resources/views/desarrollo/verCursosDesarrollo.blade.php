@extends('layouts.app')

@section('cursosDesarrollo')

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Descripcion</th>
        <th scope="col">cant Unidades</th>
        <th scope="col">Acción</th>
      </tr>
    </thead>
    <tbody>
      @for($i = 0; $i < count($cursos); $i++)
            <tr>
              <th scope="row">{{$i}}</th>
              <td>
                <a href="{{route('Curso.showDes',['id' => $cursos[$i]['id']])}}"> {{$cursos[$i]['nombre']}}</a>

                <form class="border-2 border-red-600 rounded p-2 mt-3" action="{{route('Curso.setVideoMuestra',['id'=>$cursos[$i]['id']])}}" method="post">
                  @csrf
                  <input class="mb-2 border-2 p-1 border-red-400" placeholder="Link..." 
                          type="text" name="url" 
                          value="{{$cursos[$i]->videoMuestra != null?$cursos[$i]->videoMuestra->url:null}}"
                  >
                  <input class="text-center bg-red-500 font-bold tracking-wider text-white w-full" type="submit" value="Cargar">
                </form>
              </td>
              <td>
                <form action="{{route('Curso.editar',['course'=>$cursos[$i]])}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <textarea id="editor-{{$i}}" name="descripcion" rows="10">{!! $cursos[$i]['descripcion'] !!}</textarea>
                  <input type="submit" class="bg-blue-500 py-2 px-5 text-white font-bold mt-2" value="Cargar">
                </form>
              </td>
              <td>{{$cursos[$i]['cant_unidades']}}</td>
              <td><a class="btn btn-danger" href="{{route ('Curso.confirmar_delete', ['id' => $cursos[$i]['id']])}}">Eliminar Curso</a></td>
            </tr>
            <script>
              ClassicEditor
                  .create( document.querySelector( '#editor-{{$i}}' ) )
                  .catch( error => {
                      console.error( error );
                  } );
          </script>
      @endfor
    </tbody>
  </table>
  
@endsection
