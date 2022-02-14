<!DOCTYPE html>
<html lang='en' dir='ltr'>

  <body style='font-family: arial'>
  <h1 style='color:gray;text-align: center'>Bienvenido a Work Now Cursos!</h1>
  <div style="margin:auto; width:220px;">

    <img src="https://worknow-cursos.com/confs/logo.png" width="220px" alt="worker-running-with-a-lot-of-documents_1012-192.jpg">
</div>

  <div style='display:block; color:white;'>
    <div style='background: #f28622;margin-bottom: 25px;'>
      <div style='padding: 10px;text-align:center;'> <p>Gracias <strong>{{$user->name ?? "nombre alumno"}}</strong> por elegirnos, en este email tendrias toda la información necesaria para acceder</p><p> a tus capacitaciones. Desplazate hacia abajo para encontrar los accesos.</p></div>
    </div>
    <div style='background: black; display:block;text-align: center; margin-top: -25px;height: 100px;'>
    	<h1 style='padding: 25px;font-weight: bold;'>Datos de Acceso:</h1>
	</div>
  </div>
  <div style='text-align: center; color:#7c8086;'>
  	<h2>Email: {{$user->email ?? "Mail@example.com"}} </h2>
  	<h2 style='font-weight: bold'>Clave: <strong>cursos</strong></h2>
  </div>
  <div style='display: block;height: 60px;background: #f9fafc;'>

  </div>
  <div style='text-align: center; color:black;margin-top: 10px;display: block;'>
  	<p style='text-align: center;' >Haz clic en el boton <strong>'ingresar'</strong> de abajo para acceder al curso. Recuerda que siempre</p><p> debes ingresar de la misma manera.</p>
  </div>

  <div style='text-align: center;'>
  	<a href='www.worknow-cursos.com' style='font-size: 22px;display: block; background: orange;width: 12%;color:black;text-decoration: none; padding: 10px;border-radius: 7px;margin-left: auto; margin-right: auto;'>INGRESAR</a>
  </div>

 <div style='color:gray;'>
  	<p>Work Now Cursos</p>
 </div>

  </body>
</html>