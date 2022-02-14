<!DOCTYPE html>
<html>
<head>
	<title>Diploma Work Now!</title>

	<style>
		body{
			height: 100%;
			width: 100%;
		}

		.texto{
			font-family:Open Sans; 
			font-size: 20px;
			text-align: center;

		}

		.nombre{
			font-family: 'Kaushan Script', 
			cursive; font-size: 30px;
			text-align: center;
		}
		.dni{
			font-family: Open sans, cursive; 
			font-size: 15px;
			text-align: center;
			margin-bottom: 20px;
		}
		.curso{
			font-family:Open Sans;
            font-weight: bold;
			font-size: 30px;
			text-align: center;
			color: #BF9A39
		}
		.flex-container {
		  display: flex;
		}
		.flex-container > div {
			  margin:50px;
			  font-size: 30px;
			}
		.medalla {
			  position: absolute;
			  top: 8px;
			  right: 16px;
			  font-size: 18px;
			}
		.center {
			  position: absolute;
			  left: -25px;
			  top: -20px;
			  width: 100%;
			  text-align: center;
			}
		.todo {
			  position: absolute;
			  left: 0;
			  bottom: 30%;
			  width: 100%;
			  text-align: center;
			  font-size: 18px;
			}
		.bottomleft {
			  position: absolute;
			  margin-bottom: 0px; 
			  bottom: 0px;
			  left: 0px;
			 }
		.bottomright {
			  position: absolute;
			  bottom: 0px;
			  right: 0px;
				}
		.horas {
			  position: absolute;
			  bottom: -110px;
			  left: 17%;
			  font-size: 18px;
			  font-family:Open Sans;
			  font-weight: bold;
			}
		.cncd {
			  position: absolute;
			  bottom: -130px;
			  right: 20%;
			  font-size: 18px;
			  font-family:Open Sans;
			  font-weight: bold;
			}
		.firma {
			position: absolute;
			bottom: -150px;
			right: 450px;
		}

	</style>

</head>
<body>

	<div>
			<div class="flex-container">
		  		<div><img src="{{ public_path('img/diploma/Worknow.png') }}" width="110"></div>
		  		<div class="center"><img src="{{ public_path('img/diploma/Titulo.png') }}" width="330" ></div>
		  		<div class="medalla"><img src="{{ public_path('img/diploma/Medalla.png') }}" width="150"></div>  
			</div>
		
		<div class="todo">
			<div class="texto">
			Se certifica que el alumno
			</div>
			<div class="nombre">
				<u>{{$user->name ?? 'Daniel Sanchez'}}</u>
			</div>
			<div class="dni">
				DNI: {{$user->datosUser->dni ?? '29.473.945'}}
			</div>
			<div class="texto">
				ha finalizado de manera destacada la diplomatura en 
			</div>
			<div class="curso">
				<u>{{$course->nombre ?? 'Energias Renovables'}}</u>
			</div>
			<div class="texto">
				<p>	con un promedio de <b> {{$course->promedio ?? 10}}</b></p>
			</div>
			<div class="texto">
				permitiendo ejercer en todo el territorio argentino.
			</div>
			<div class="horas">
				Horas cátedra: 120 hs.
			</div>
			<div class="firma">
				<img src="{{ public_path('img/diploma/firma.png') }}" width="130">
			</div>
			<div class="cncd">
				<img src="{{ public_path('img/diploma/cncd.png') }}" width="90">
			</div>

			<div>
		  		<div class="bottomleft"><img src="{{ public_path('img/diploma/abajoizq.png') }}" width="170"></div>
		  		<div class="bottomright"><img src="{{ public_path('img/diploma/abajoder.png') }}" width="170"></div>
		  	</div>
		</div>
	</div>

</body>
</html>