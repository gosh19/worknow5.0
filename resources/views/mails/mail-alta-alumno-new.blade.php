<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Asap:wght@400;600&display=swap" rel="stylesheet">
</head>


<body>
	<h1 style="font-family:Lalezar; color:#F50E1C; text-align: center; font-size: 50px">
		Bienvenidos a Work Now Cursos
	</h1>
	

	<div style="display:block; color:white;">
    <div>
      <div style="padding: 10px;text-align:center;"> 
      		<h2 style="font-family:Asap; color:white; text-align: center"> 
	     		<span style="background-color: #F50E1C; padding:10px">
	     			¡Gracias {{$user->name ?? "nombre alumno"}} por elegirnos!
	     		</span>
			</h2>
		 </div>
    </div>

    <div style="margin:auto; width:220px;">

      <img src="https://worknow-cursos.com/confs/logo.png" width="220px" alt="worker-running-with-a-lot-of-documents_1012-192.jpg">
    </div>

	<div style="display:block; color:white; padding: 40px">
    	<div style="background:linear-gradient(#F50E1C, #F5850E);margin-bottom: 25px; margin-left: 50px; margin-right: 50px; padding: 10px;text-align:center">
      		<h2 style="font-family:Asap"> <p>En este email tendrias toda la información necesaria para acceder a tus capacitaciones.</p><p>Desplazate hacia abajo para encontrar los accesos.</p></h2>
      	</div>
    </div>

    <h1 style="color:orange; text-align: center; font-family:Asap">
		<span style="border: 3px solid orange; padding:10px; border-radius: 9px">
			Datos de acceso
		</span>
	</h1>


	  <div style="text-align: center; color:#7c8086; font-family:Asap">
  	<h2>Email: {{$user->email ?? "Mail@example.com"}} </h2>
  	<h2 style="font-weight: bold">Clave: <strong>cursos</strong></h2>
  </div>
  <div style="display: block;height:">

  </div>
  <div style="text-align: center; color:black;margin-top: 10px;display: block; font-family:Asap">
  	<p style="text-align: center;">Haz clic en el boton <strong>'ingresar'</strong> de abajo para acceder al curso. Recuerda que siempre</p><p> debes ingresar de la misma manera.</p>
  </div>

  <div style="text-align: center;">
  	<a href="http://www.worknow-cursos.com" style="font-size: 25px;display: block; background: orange;width: 12%;color:white;text-decoration: none; padding: 10px; border-radius: 7px;margin-left: auto; margin-right: auto; font-family:Lalezar">INGRESAR</a>
  </div>



</body>


</html>