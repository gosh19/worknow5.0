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

      <img src="https://worknow-cursos.com/img/Escritorio.png" width="220px" alt="worker-running-with-a-lot-of-documents_1012-192.jpg">
    </div>

    <div style="display:block; color:white; padding: 40px">
        <div style="
                    background:linear-gradient(#F50E1C, #F5850E);
                    margin-bottom: 25px; 
                    margin-left: 50px; 
                    margin-right: 50px; 
                    padding: 20px;
                    text-align:center"
        >
            <h2 style="font-family:Asap"> 
                Se ha agregado el curso de {{$course->nombre ?? "Curso"}} 
            </h2>
            <p style="font-size: 20px;">Te deseamos una excelente cursada y no olvides consultar con tu docente por cualquier duda.</p>
            <a style="
                        font-size: 25px;
                        font-weight: bold;
                        color:rgb(255, 255, 255);
                        border: 2px solid rgb(114, 42, 8);
                        background: rgb(230, 45, 57);
                        text-decoration: none;
                        border-radius:15px;
                        padding: 10px;
                    " 
                href="https://worknow-cursos.com/">Ir al aula</a>
        </div>
    </div>



</body>


</html>