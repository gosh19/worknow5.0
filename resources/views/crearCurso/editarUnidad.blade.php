@extends('../layouts/app')

@section('content')
  <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              Crear Unidad
            </div>
            <ul class="list-group list-group-flush">
              <form class="" action="/Unidad/Editar/{{$unidad['id']}}" method="post" enctype="multipart/form-data">
                @csrf
                <li class="list-group-item">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon3"><strong>Nombre Unidad:</strong></span>
                    </div>
                    <input type="text" name="nombre" value="{{$unidad['nombre']}}" class="form-control" id="basic-url" aria-describedby="basic-addon3" required>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><strong>Descripción</strong></span>
                    </div>
                    <textarea name="descripcion" class="form-control" aria-label="With textarea" rows="8" required>{{$unidad['descripcion']}}</textarea>
                  </div>
                </li>
                <li class="list-group-item"><input type="submit" name="boton" value="Terminar" class="btn btn-danger btn-block" /></li>
              </form>
              <li class="list-group-item">
                <a onclick="javascript: return confirm('¿Seguro que desea eliminar la unidad? Se eliminaran todos los modulos y tps')" href="{{route('Unidad.eliminar', ['Unity' => $unidad])}}" class="btn btn-warning btn-block">ELIMINAR UNIDAD</a>
              </li>
            </ul>
  <br><br>
<div class="container">
              <div class="card">
                <div class="card-header text-center bg-info text-white"><strong>Módulos</strong></div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Save</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Ver</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($unidad->modules as $module)
                          <form action="{{route('Moudule.updatee',['Module'=>$module])}}" method="POST">{{--AGARRO TODA LA FILA PARA Q NO ME JODA EL DISEÑO--}}
                            @csrf
                            <tr>
                              <td><input type="text" name="titulo" value="{{$module->titulo}}" id=""></td>
                              <td><input class="bg-orange-500 py-1 px-2 font-bold rounded" type="submit" value="Guardar"></td>
                              <td><a class="btn btn-danger" href="{{ route('Modulo.delete', ['unidad' => $unidad ,'module_id' => $module['id']])}}">Eliminar modulo</a></td>
                              <td><strong><a class="bg-blue-500 py-1 px-2 text-white" href={{ asset($module->url) }}>Ver</a></strong></td>
                            </tr>
                          </form>
                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
<br><br>
            <div class="card">
              <div class="card-header bg-info text-center text-white"><strong>Trabajos Prácticos</strong></div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th scope="col">N °</th>
                    <th scope="col">Accion </th>
                  </tr>
                   </thead>
                     <tbody>
                       @foreach ($unidad->tps as $tp)
                           
                       <tr>
                         <td><strong><a href={{ asset($tp->url) }}>Trab. Práctico N°{{$tp['numero']}}</a></strong> </td>
                         <td><a class="btn btn-danger" href="{{ route('Tp.delete', ['tp_id' => $tp['id']])}}">Eliminar tp</a></td>
                        </tr>
                        @endforeach
                     </tbody>
                   </table>
              </div>

            </div>
            <div class="card">
              <div class="card-header bg-info text-center text-white"><strong>Trabajos Prácticos Finales</strong></div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th scope="col">N °</th>
                    <th scope="col">Accion </th>
                  </tr>
                   </thead>
                     <tbody>
                       @foreach ($unidad->tpsFinals as $tpFinal)
                           
                       <tr>
                         <td><strong><a href={{ asset($tpFinal->url) }}>Tp Final</a></strong> </td>
                         <td><a class="btn btn-danger" href={{ route('Unity.deleteTpFinal', ['id'=>$tpFinal->id]) }}>Eliminar tp</a></td>
                        </tr>
                        @endforeach
                     </tbody>
                   </table>
              </div>

            </div>
</div>
</div>


      <div class="col-md-4">
        <div class="card">
          <div class="card-header"><strong> Agregar TP </strong></div>
          <div class="card-body">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
                </div>
                <div class="custom-file">
                  <form class="form-control" action="{{ route('Unidad.addTP', ['unity_id' => $unidad->id]) }}" enctype="multipart/form-data" method="POST">
                      @csrf
                    <input type="file" name="tp" class="custom-file-input" id="file1" aria-describedby="inputGroupFileAddon01"><br>
                    <input id="input" class="custom-file-label text-left" for="inputGroupFile01" placeholder="Seleccionar archivo" /><br>
                </div>
              </div>
              <input type="number" style="margin-top: 10px;" class="form-control" name="tpNum" placeholder="Ingrese numero del TP" style="width: 100%" required />
              <input  type="submit" class="btn btn-danger text-center" style="margin-top: 10px;" value="Enviar TP!">
            </form>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header"><strong> Agregar Módulo </strong></div>
          <div class="card-body">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon02">Subir</span>
                </div>
                <div class="custom-file">
                  <form class="form-control" action="{{ route('Modulo.addModulo', ['unity_id' => $unidad->id]) }}" enctype="multipart/form-data" method="POST">
                      @csrf
                    <input type="file" name="modulo" class="custom-file-input" id="file2" aria-describedby="inputGroupFileAddon02"><br>
                    <input id="input2" class="custom-file-label text-left" for="inputGroupFile02" placeholder="Seleccionar archivo" /><br>
                </div>
              </div>
              <input type="text" style="margin-top: 10px;" class="form-control" name="nombre" placeholder="Ingresar nombre del módulo" style="width: 100%" required />
              <input  type="submit" class="btn btn-danger text-center" style="margin-top: 10px;" value="Enviar Modulo!">
            </form>
          </div>
        </div>

        <div class="card">
          <div class="card-header bg-primary mt-3"><strong> Agregar Tp Final <span class="badge badge-danger">New</span> </strong></div>
          <div class="card-body">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon02">Subir</span>
                </div>
                <div class="custom-file">
                  <form class="form-control" action="{{ route('Unity.addTpFinal', ['unity_id' => $unidad->id]) }}" enctype="multipart/form-data" method="POST">
                      @csrf
                    <input type="file" name="tpFinal" class="custom-file-input" id="file2" aria-describedby="inputGroupFileAddon02"><br>
                    <input id="input2" class="custom-file-label text-left" for="inputGroupFile02" placeholder="Seleccionar archivo" /><br>
                </div>
              </div>
              <input  type="submit" class="btn btn-danger text-center" style="margin-top: 10px;" value="Enviar Modulo!">
            </form>
          </div>
        </div>

        <div class="card">
          <div class="card-header bg-danger mt-3"><strong> Agregar Tp V/F <span class="badge badge-primary">New</span> </strong></div>
          <div class="card-body">
              <ul class="list-group">
                @foreach ($unidad->tpsVf as $index => $tp)
                    <li class="list-group-item d-flex"> 
                      <span class="bg-info p-2 rounded font-weight-bold text-white">{{$index}}</span>
                      <a class="btn btn-outline-dark w-100 mr-1 ml-1" href="{{route ('TpVf.create',[ 'unity_id' => $unidad->id, 'tp_id'=>$tp->id])}}">Editar Tp</a>
                      <a onclick="javascript:return confirm('Estas seguro?');" class="btn btn-danger" href="{{route('TpVf.destroy',['id'=>$tp->id])}}">Eliminar</a>
                    </li>
                @endforeach
              </ul>
              <a class="btn btn-outline-dark w-100" href="{{route ('TpVf.create',[ 'unity_id' => $unidad->id])}}">Crear TP</a>
          </div>
        </div>
      </div>
  </div>
</div>


<script>
      $(document).ready(function() {
        $('#file1').change(function() {
          var val = ($(this).val()) ? $(this).val() : "No seleccionó ningún archivo!.";
          $('#input').attr('placeholder', val);
        });
      });
</script>

<script>
      $(document).ready(function() {
        $('#file2').change(function() {
          var val = ($(this).val()) ? $(this).val() : "No seleccionó ningún archivo!.";
          $('#input2').attr('placeholder', val);
        });
      });
</script>

@if (session('success'))
    <script>
      swal('Bien hecho!', 'unidad modificada con exito', 'success');
    </script>
@endif

@endsection
