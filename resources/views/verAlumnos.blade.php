@extends('layouts.app')

@section('content')

  @if(session()->has('habiztado'))
    <script>
        swal("Alumno habiztado", "Se sumaron 5 días a la fecha de siguiente cobro del alumno", "success");
    </script>
  @endif

  @if(session()->has('massage'))
    <script>
        swal("Cobro cargado con exito", "Ahora debe buscar nuevamente el alumno, dado a que al cargar el cobro aumento un mes en su fecha de siguiente cobro", "success");
    </script>
  @endif

  @if(session()->has('cargado'))
    <script>
        swal("Cobro cargado con exito", "Ahora debe buscar nuevamente el alumno, dado a que al cargar el cobro aumento un mes en su fecha de siguiente cobro", "success");
    </script>
  @endif

  <div class="container">
    <div class="row justify-content-center">
      <div class="selDiv">
          <select id="selected" class="form-control">
            <option selected value="">Buscar Por Nombre o por Cobro </option>
            <option value="nombre">Nombre</option>
            <option value="cobro">Cobros</option>
          </select>
      </div>
      <div class="col-md-12 mt-3">
        <form accept-charset="utf-8" method="POST">
          <input style="display:none;" type="text" class="form-control" name="busqueda" id="busqueda" value="" placeholder="Buscar por nombre o Email" maxlength="30" autocomplete="off" onKeyUp="buscar();" />
          <select style="display:none;" name="busqueda" id="busqueda2" class="form-control" onChange="buscar2();">
            <option selected value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select>
        </form>
        <div id="resultadoBusqueda"></div>
      </div>
    </div>
  </div>




  <script>


  $('#selected').change(function(){
      var value = $('#selected').val();
      if(value == "nombre"){
        $("#busqueda2").hide("slow");
        $("#busqueda").show("slow");
      }
      if(value == "cobro"){
        $("#busqueda").hide("slow");
        $("#busqueda2").show("slow");
      }
  });


function buscar() {
    var textoBusqueda = $("#busqueda").val();

    if (textoBusqueda != "") {
       $.post("buscar.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
           $("#resultadoBusqueda").html(mensaje);
       });
   } else {
       ("#resultadoBusqueda").html('<p>No se encontro nada</p>');
 };
};

function buscar2() {
    var textoBusqueda = $("#busqueda2").val();

    if (textoBusqueda != "") {
       $.post("buscar2.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
           $("#resultadoBusqueda").html(mensaje);
       });
   } else {
       ("#resultadoBusqueda").html('<p>No se encontro nada</p>');
 };
};
</script>

@endsection
