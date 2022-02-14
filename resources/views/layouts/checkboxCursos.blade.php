@php
  use App\Course;
  //TEMPLATE DE TODOS LOS CURSOS CON checkbox
  //CADA CHECK DEVUELVE EN EL REQUEST EL ID DEL Curso

  $cursos = Course::orderBy('nombre','asc')->get();
@endphp
<hr/>
  @php
    $i=0;
  @endphp
  <div >
    
    @foreach ($cursos as $cur)
      <div class="flex">
        <input type="checkbox" class="form-check-input flex self-center  checked:bg-gray-900 mx-3" name="curso[{{$i}}]" value="{{$cur['id']}}">
        <label class="form-check-label text-2xl ml-5" for="exampleCheck1">{{$cur['nombre']}}</label>
      </div>
      @php
        $i++;
      @endphp
    @endforeach
  </div>
<hr/>