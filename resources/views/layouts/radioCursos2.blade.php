@php
  //TEMPLATE DE TODOS LOS CURSOS CON checkbox
  //CADA CHECK DEVUELVE EN EL REQUEST EL ID DEL Curso

  $cursos = \App\Course::all();

@endphp
<ul class="list-group list-group-flush">
  @foreach ($cursos as $i => $cur)
    <div class="form-check">
      @if (isset($course_id))
      <input type="radio" class="form-check-input" name="course_id" value="{{$cur->id}}"
          @if ($course_id == $cur->id)
           checked   
          @endif
          >
      @else
      <input type="radio" class="form-check-input" name="course_id" value="{{$cur->id}}">
      @endif
      <label class="form-check-label" for="exampleCheck1">{{$cur->nombre}}</label>
    </div>
  @endforeach
</ul>