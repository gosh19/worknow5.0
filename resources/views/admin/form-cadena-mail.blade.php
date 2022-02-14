@extends('layouts.app')

@section('content')
<form class="" action={{route('Admin.envioCadena')}} method="post">
    @csrf
    @include('layouts.radioCursos')
    <div class="card m-5">
        <div class="card-header bg-danger text-white font-weight-bolder">
            Ingrese texto a enviar
        </div>
        <div class="card-body">
            <div class="row">
                
                <h3>Correo cadena</h3>
            </div>
            <div class="row">
                <div class="alert alert-danger m-3">
                    <h3>Atencion!</h3>
                    <p>
                        En caso de seleccionar curso pero no unidad se enviara un mail con el texto detallado.
                        Y el asunto descripto.
                    </p>
                    <p>
                        En caso de seleccionar la unidad se enviara el correo de contenido nuevo
                    </p>
                    </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Asunto</label>
                <input type="text" name="subject" class="form-control" id="exampleInputPassword1">
              </div>
            <div class="row">
                <div class="mb-3 p-3">
                    <label for="validationTextarea">Mensaje</label>
                    <textarea class="form-control" name="texto" cols="130" rows="6" id="validationTextarea" placeholder="Texto..." required></textarea>
                    <div class="invalid-feedback">
                      Ingrese el mensaje a enviar.
                    </div>
                </div>
            </div>

            <input type="submit" name="" value="Cargar">
        </div>

    </div>
  </form>
@endsection