@extends('./layouts.app')

@section('content')
  <div class="container">
    <h1>Alumno numero: {{session('id')}}</h1>
    <form class="" action="{{route('DatosUser.store', ['id'=>session('id')] )}}" method="post">
      @csrf

      <div class="input-group mb-3">
        <input type="text" name="dni" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="D.N.I." required>
      </div>

      <div class="input-group mb-3">
        <input type="text" name="direccion" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Direccion" required>
      </div>

      <div class="input-group mb-3">
        <input type="text" name="telefono" class="form-control" name="direccion" placeholder="Telefono" aria-label="Username" aria-describedby="basic-addon1" required>
      </div>

      <div class="input-group mb-3">
        <input type="text" name="ciudad" class="form-control" placeholder="Ciudad" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
      </div>

      <label for="provincia">Provincia</label>
      <select class="form-control mb-3" id="provincia" name="provincia" >
          <option value="Buenos Aires">Bs. As.</option>
          <option value="Catamarca">Catamarca</option>
          <option value="Chaco">Chaco</option>
          <option value="Chubut">Chubut</option>
          <option value="Cordoba">Cordoba</option>
          <option value="Corrientes">Corrientes</option>
          <option value="Entre Rios">Entre Rios</option>
          <option value="Formosa">Formosa</option>
          <option value="Jujuy">Jujuy</option>
          <option value="La Pampa">La Pampa</option>
          <option value="La Rioja">La Rioja</option>
          <option value="Mendoza">Mendoza</option>
          <option value="Misiones">Misiones</option>
          <option value="Neuquen">Neuquen</option>
          <option value="Rio Negro">Rio Negro</option>
          <option value="Salta">Salta</option>
          <option value="San Juan">San Juan</option>
          <option value="San Luis">San Luis</option>
          <option value="Santa Cruz">Santa Cruz</option>
          <option value="Santa Fe">Santa Fe</option>
          <option value="Sgo. del Estero">Sgo. del Estero</option>
          <option value="Tierra del Fuego">Tierra del Fuego</option>
          <option value="Tucuman">Tucuman</option>
      </select>

      <div class="input-group mb-3">
        <input type="text" name="CP" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Codigo Postal" required>
      </div>

      <div class="input-group mb-3">
        <input type="text" name="tarjeta" id="tc" onkeydown="validationCreditCard()" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Tarjeta" required>
      </div>
      <div id="msjTc" style="display: none"></div>
      
      @include('layouts.countryRadio')
      
      @include('layouts.kit-types',['user_id'=> session('id')])


      <h5>Seleccione metodo de pago:</h5>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text bg-danger text-white" for="inputGroupSelect01">METODO DE PAGO</label>
        </div>
        <select name="tipo_pago" class="custom-select" id="inputGroupSelect01">
          <option value="credito">Tarjeta de credito</option>
          <option value="efectivo">Cupon</option>
          <option value="efectivoTotal">Cupon Total</option>
          <option value="test">Modo de prueba</option>
        </select>
      </div>

      <input type="submit" name="boton" value="Cargar" class="btn btn-primary">
    </form>
    <div class="card mt-3">
      <div class="card-header bg-info">
      <strong>  Validador de tarjetas </strong>- coloque los digitos en el campo y luego presione fuera para verificar
      </div>
      <iframe src="/sss" frameborder="0" width="100%"></iframe>
    </div>
  </div>
@endsection
