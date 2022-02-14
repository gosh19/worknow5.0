<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<div class="container-fluid P-5">
    <div class="row">
        <div class="col-10">

            <div class="row mb-3">
                <h2 style="color: rgb(148, 134, 197)" >WORK NOW SHOP ONLINE</h2>
            </div>
            <div class="row mb-3">
                <p>MAR DEL PLATA ARGENTINA</p>
            </div>
        </div>
        <div class="col-2">
            <img width="100%" src="{{ asset('img/logo.jpg') }}" alt="">
        </div>
    </div>
    <div class="row">

        <h1 style="color: rgb(77, 77, 77)" ><b>Nombre y apellido :</b> {{$user->name}}</h1>
    </div>
    <div class="row justify-content-between">

        <h1 style="color: rgb(77, 77, 77)" ><b>Direccion :</b> {{$user->datosUser->direccion ?? 'error'}}</h1>
        <h1 style="color: rgb(77, 77, 77)" class="mr-5" ><b>CP :</b> {{$user->datosUser->CP ?? 'error'}}</h1>
    </div>
    <div class="row">

        <h1 style="color: rgb(77, 77, 77)" ><b>Localidad :</b> {{$user->datosUser->ciudad ?? 'error'}}</h1>
    </div>
    <div class="row">

        <h1 style="color: rgb(77, 77, 77)" ><b>Provincia :</b> {{$user->datosUser->provincia ?? 'error'}}</h1>
    </div>
    <div class="row">

        <h1 style="color: rgb(77, 77, 77)" ><b>Telefono :</b> {{$user->datosUser->telefono ?? 'error'}}</h1>
    </div>
    <div class="row">

        <h1 style="color: rgb(77, 77, 77)" ><b>E-mail :</b> {{$user->email ?? 'error'}}</h1>
    </div>
    <div class="row">

        <h1 style="color: rgb(77, 77, 77)" ><b>RTT :</b> Work Now shop online</h1><br>
    </div>
    <p>Luro 3301. Mar del plata CP: 7600 - Galeria Moran oficina 3 </p>

</div>