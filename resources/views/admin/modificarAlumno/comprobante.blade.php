<!DOCTYPE html>
<html>
<head>
<style>
body{
    padding: 25px;
    font-family: Arial, Helvetica, sans-serif;
}
p{
    font-size: 20PX;
    
}
ul{
    padding-left: 10px !important;
}
li{
    list-style: none;
}
.grid-container {
  display: grid;
  grid-template-columns: 150px 150px 150px 150px 150px 150px 150px 150px;
  grid-template-rows: 100px 100px 100px  ;
  grid-gap: 10px;
  padding: 10px;
}

.logo{
    grid-column: 1;
    grid-row: 1/3;
}
.orden{
    border: 1px solid black !important;
    grid-column: 3/7;
    padding-left: 20px;
}
.datos{
    border: 1px solid black !important;
    grid-column: 3/7;
    grid-row: 2/4;
}


.datos-wn{
    grid-column: 1/3;
    grid-row: 3;
}
.tabla{
    margin-top: 20px !important;
    margin-bottom: 20px !important;
}
table{
    width: 960px;
}
table, th, td {
  border: 1px solid rgb(105, 105, 105);
  border-style: groove;
}
.footer{
    width: 940px;
    border: 1px solid black;
    padding-left: 20px;
}

</style>
</head>
<body>

<div class="grid-container">
  <div class="logo">
      <img src="{{ asset('img/logo.jpg') }}" width="150px" alt="">
  </div>
  <div class="datos-wn">
    <ul style="font-weight: bold;padding-left: 0px !important;">
        <li>WORK NOW SHOP ONLINE</li>
        <li>MAR DEL PLATA ARGENTINA</li>
        <li>223-6772444</li>
        <li>WORKNOWSHOP@GMAIL.COM</li>
        <li>WORKNOWCURSOS@GMAIL.COM</li>
    </ul>
  </div>
  <div class="orden">
    <p>ORDEN DE DESPACHO</p>
    <p>N° {{$user->id.'-'.rand ( 1000 , 9999 ).'-'.rand ( 10 , 99 ) }} </p>
  </div>
  <div class="datos">
    <ul>
        <li><b>SEÑOR/A:</b> {{$user->name}} </li>
        <li><b>DIRECCION:</b> {{$user->datosUser->direccion ?? 'error'}} </li>
        <li><b>LOCALIDAD:</b> {{$user->datosUser->ciudad ?? 'error'}} </li>
        <li><b>GIRO:</b> DESPACHO </li>
        <li><b>FECHA:</b> {{date('d/m/Y')}} </li>
        <li><b>CODIGO POSTAL:</b> {{$user->datosUser->CP ?? 'error'}} </li><br>
        <li><b>CELULAR:</b> {{$user->datosUser->telefono ?? 'error'}} </li>
        <li><b>EMAIL:</b> {{$user->email ?? 'error'}} </li>
    </ul>    
  </div>  
</div>
<div class="tabla">
    <table>
        <thead>
            <th>CANTIDAD</th>
            <th>CODIGO</th>
            <th style="width: 400px;">DETALLE</th>
            <th>PRECIO UNITARIO</th>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($data as $d)
                @php
                    $total += ($d['valor']*$d['cant']);
                @endphp
                <tr>
                    <td>{{$d['cant']}}</td>
                    <td>{{$d['codigo']}}</td>
                    <td>{{$d['name']}}</td>
                    <td>{{$d['valor']}}</td>
                </tr>

            @endforeach
            <tr style="height: 40px;">
                <td style="background-color: black;"></td>
                <td style="background-color: black;"></td>
                <td style="background-color: black;"></td>
                <td><b>Total</b> {{$total}}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="footer">
    <p  style="font-size: 15px;">ENTREGO : WORK NOW SHOP ONLINE</p>
    <p  style="font-size: 15px;">RECIBIO : {{$user->name}} </p>
</div>
</body>
</html>