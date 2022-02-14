<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Asap:wght@400;600&display=swap" rel="stylesheet">
</head>


<body>
	<h1 style="font-family:Lalezar; color:rgb(245, 14, 14); text-align: center; font-size: 50px">
		Work Now Cursos
	</h1>
	

	<div style="display:block; color:white;">
    <div>
      <div style="padding: 10px;text-align:center;"> 
      		<h2 style="font-family:Asap; color:white; text-align: center"> 
	     		<span style="background-color: rgb(14, 76, 245); padding:10px">
	     			¡Hola {{$user->name ?? "nombre alumno"}}!
	     		</span>
			</h2>
		 </div>
    </div>

    <div style="margin:auto; width:220px;">

      <img src="https://worknow-cursos.com/img/lupa.jpg" width="220px" alt="worker-running-with-a-lot-of-documents_1012-192.jpg">
    </div>

	  <div style="display:block; color:white; padding: 40px">
    	<div style="background:linear-gradient(rgb(14, 56, 245), rgb(14, 172, 245));margin-bottom: 25px; margin-left: 50px; margin-right: 50px; padding: 10px;text-align:center">
            <h2 style="font-family:Asap"> 
                <p>Se ha bloqueado el ingreso al aula virtual.</p>
                <p>Para mas informacion dirigirse al WhatsApp y consultar con su profesor.</p>
            </h2>
      	</div>
    </div>
    <div style="background:linear-gradient( rgb(14, 122, 245),rgb(14, 76, 245));margin-bottom: 25px; margin-left: 50px; margin-right: 50px; padding: 10px;text-align:center">
        <h2>Codigo de Bloqueo</h2>
        <h1>WN-{{$user->id ?? "12"}}</h1>
    </div>

  <div style="text-align: center;">
      <a href="https://wa.me/5491126942226?text=Hola%20me%20bloquearon%20el%20ingreso%20a%20la%20plataforma%20con%20el%20codigo%20WN-{{$user->id ?? "12"}}" style="font-size: 25px;display: block; background: rgb(0, 132, 255);width: 20%;color:white;text-decoration: none; padding: 10px; border-radius: 7px;margin-left: auto; margin-right: auto; font-family:Lalezar">
        ¡Presiona aqui!
        <img style="width: 90%;" src="https://worknow-cursos.com/img/whatsapp.png" >
    </a>
  </div>



</body>


</html>