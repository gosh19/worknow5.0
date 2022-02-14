<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    	<link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Asap:wght@400;600&display=swap" rel="stylesheet">
    	<title>Mail informativo</title>
	</head>
<body>
    <div style="width:70%; margin:auto; padding: 20px; ">
        <div style="text-align:center"><span style="color:#F50E1C;font-size:50px;font-family:lalezar;font-weight:bold">Work Now Cursos</span></div>
        <div style="display:block; width:100%;margin-top:30px;margin-bottom:30px">
            <div style="margin:auto; width:220px;">

                <img src="https://worknow-cursos.com/img/logo.jpg" width="200px" alt="worker-running-with-a-lot-of-documents_1012-192.jpg">
            </div>
        </div>
        <div style="display:block; margin:auto;text-align:center;font-family:Asap;font-size: 20px">
            <span style="color:#F50E1C; font-size: 30px"><p>Hola <strong>{{$nombre ?? "Nombre"}}</strong>!</p></span>
            <p>Muchas gracias por interesarte en nuestras capacitaciones.</p>
            
            <p style="margin-bottom: 60px;">Para poder acceder hoy mismo podes abonar con tarjeta de débito el siguiente cupón de pago</p>
             	 <div style="text-align: center;">
  					<a href="{{$url ?? '#'}}" style="font-size: 25px; background: orange;width: 12%;color:white;text-decoration: none; padding: 10px; border-radius: 7px;margin-left: auto; margin-right: auto; font-family:Lalezar">CUPON DE PAGO</a>
 				 </div>
                <hr style="margin-top:40px;">
            <p style="margin-top:40px;">Una vez abonado podra ingresar inmediatamente al curso de</p>
     			<h1 style="color:orange; text-align: center; font-family:Asap">
					<span style="border: 2px solid orange; padding:6px; border-radius: 9px; font-size: 25px">
						{{str_replace('Test', '', $curso->nombre ?? "Curso") }}
					</span>
				</h1>

        </div>
            <h3 style="text-align:center;font-family: lalezar">Ante cualquier consulta puede dirigirse directamente a este correo <br> o via WhatsApp al <span style="color:#088A08"> +54 9 11 2694-2226</span></h3>
    </div>

</body></html>