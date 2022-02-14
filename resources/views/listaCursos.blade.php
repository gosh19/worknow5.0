@extends('layouts.app')

@section('content')
<div class="container">

  <div class="card">
    <div class="card-header">
      Cursos
    </div>
    <ul class="list-group list-group-flush">
      @foreach ($cursos as $curso)
        @if (Auth::user()->rol == "admin")
          <li class="list-group-item"><a href="{{ route('Curso.showAdmin', ['id' => $curso->id])}} ">{{$curso['nombre']}}</a></li>
        @endif
        @if (Auth::user()->rol == "postventa")
          <li class="list-group-item"><a href="{{ route('Curso.showPostVenta', ['id' => $curso['id']])}} ">{{$curso['nombre']}}</a></li>
        @endif  
      @endforeach
      <li class="list-group-item"><button type="button" class="btn btn-primary" onclick="mostrar()">Mas</button></li>
      <div id="asd"><div>
    </ul>
  </div>
</div>

@endsection
<script type="text/javascript">

  function mostrar() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('asd').innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST", "/test.php", false);
    xmlhttp.send();

  }
</script>
