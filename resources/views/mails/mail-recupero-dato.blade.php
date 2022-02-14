<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Asap:wght@400;600&display=swap" rel="stylesheet">
</head>


<body>
	<h1 style="font-family:Lalezar; color:#F50E1C; text-align: center; font-size: 50px">
		Work Now Cursos
	</h1>
	

	<div style="display:block; color:white;">
    <div>
      <div style="padding: 10px;text-align:center;"> 
      		<h2 style="font-family:Asap; color:white; text-align: center"> 
	     		<span style="background-color: #F50E1C; padding:10px">
	     			¡Hola {{$user->name ?? "nombre alumno"}}!
	     		</span>
			</h2>
		 </div>
    </div>

    <div style="margin:auto; width:220px;">

      <img src="https://worknow-cursos.com/img/megafono.jpg" width="220px" alt="worker-running-with-a-lot-of-documents_1012-192.jpg">
    </div>

	  <div style="display:block; color:white; padding: 40px">
    	<div style="background:linear-gradient(#F50E1C, #F5850E);margin-bottom: 25px; margin-left: 50px; margin-right: 50px; padding: 10px;text-align:center">
            <h2 style="font-family:Asap"> 
                <p>Queriamos saber si aun estas interesado en estudiar con nosotros el curso de {{$user->course->nombre ?? "nombre curso"}} .</p>
                <p>Tenemos para ofrecerte un descuento para que te puedas inscribir con un  unico pago de $3000 .</p>
                <p>Envianos un mensaje presionando el boton de whatsapp mas abajo para mas informacion o contesta este correo directamente.</p>
            </h2>
      	</div>
    </div>
    <div style="background:linear-gradient( #F5850E,#F50E1C);margin-bottom: 25px; margin-left: 50px; margin-right: 50px; padding: 10px;text-align:center">
        <h2>Codigo Promocional</h2>
        <h1>WN-{{$user->user->id ?? "3789"}}-{{$user->id ?? "12"}}</h1>
        <h5>Vencimiento: {{$user->vencimiento ?? "dd-mm-YYYY" }}</h5>
    </div>

  <div style="text-align: center;">
      <a href="https://wa.me/5491126942226?text=Hola%20me%20llego%20este%20codigo%20promocional%20(WN-{{$user->user->id ?? "3789"}}-{{$user->id ?? "12"}})%20por%20el%20curso%20de%20{{$user->course->nombre ?? "nombre curso"}}" style="font-size: 25px;display: block; background: orange;width: 20%;color:white;text-decoration: none; padding: 10px; border-radius: 7px;margin-left: auto; margin-right: auto; font-family:Lalezar">
        ¡Presiona aqui!
        <img style="width: 90%;" src="https://worknow-cursos.com/img/whatsapp.png" >
    </a>
  </div>



</body>


</html>