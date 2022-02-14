@php
  use App\Course;
  //TEMPLATE DE TODOS LOS CURSOS CON checkbox
  //CADA CHECK DEVUELVE EN EL REQUEST EL ID DEL Curso

  $cursos = Course::with('unities')->get();
  $cantidad = count($cursos);
  $i =0;
@endphp
<div class="card">
<div class="card-header">
  Cursos
</div>
<ul class="list-group list-group-flush" id="weno">

  @foreach ($cursos as $cur)
    <li class="list-group list-group-item">
      <input type="radio" class="form-check-input" name="curso_id" value="{{$cur['id']}}" onclick="mostrar({{$i}})">
      <label class="form-check-label" for="exampleCheck1">{{$cur['nombre']}}</label>
      <div id="panel{{$i}}">
        <div class="card">

          <div class="card-header">
            Unidades
          </div>
          <ul class="list-group list-group-flush">
            @foreach ($cur['unities'] as $unidad)
              <li class="list-group list-group-item">
                <input type="radio" class="form-check-input" name="unidad_id" value="{{$unidad['id']}}">
                <label class="form-check-label" for="exampleCheck1">{{$unidad['nombre']}}</label>
              </li>
            @endforeach
          </ul>
        </div>

    </div>
  </li>
  @php
    $i++;
  @endphp
  @endforeach
</ul>
</div>

<script type="text/javascript">


ocultar();

function ocultar() {
  for (var i = 0; i < {{$cantidad}}; i++) {
    $("#panel"+i).slideUp();
  }
}

function mostrar(numero) {
  ocultar();
  $("#panel"+numero).slideDown();
}


</script>
