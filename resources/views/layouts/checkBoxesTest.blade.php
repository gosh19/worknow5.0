@php
  //TEMPLATE DE TODOS LOS CURSOS CON checkbox
  //CADA CHECK DEVUELVE EN EL REQUEST EL ID DEL Curso

  $cursos = \App\CourseTest::all();

@endphp

<h2 class="alert alert-primary">Seleccionas los cursos que queres probar!</h2>
<h5 class="alert alert-warning">Podes probarlos todos y ver cual te gusta mas!</h5>
<ul class="list-group list-group-flush">
  @php
    $i=0;
  @endphp
  @foreach ($cursos as $cur)
    <div class="form-check">
      <input type="checkbox" class="form-check-input" name="curso[{{$i}}]" value="{{$cur['course_id']}}">
      <label class="form-check-label" for="exampleCheck1">{{$cur->course->nombre}}</label>
    </div>
    @php
      $i++;
    @endphp
  @endforeach
</ul>
