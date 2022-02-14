<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Mail informativo</title>
</head>
<body>
    <div style="text-align:center"><span style="color:rgb(102,0,0);font-size:xx-large;font-family:Arial;font-weight:bold">Work Now Cursos</span></div>
    <div style="display:block; width:100%;margin-top:30px;margin-bottom:30px">
        <div style="margin:auto; width:220px;">

            <img src="https://worknow-cursos.com/confs/logo.png" width="220px" alt="worker-running-with-a-lot-of-documents_1012-192.jpg">
        </div>
    </div>
    <div style="width:60%; display:block; margin:auto;text-align:center;font-family:Arial;">
    <p>Hola <strong>{{$nombre ?? "Nombre"}}</strong>! Cómo estás? Muchas gracias por interesarte en nuestras 
            capacitaciones. En este e-mail te brindaremos <strong> toda la información sobre 
            la cursada</strong>, pero de igual manera te recomendamos dejar tu número 
            telefónico para obtener atención personalizada con uno de nuestros
            Asesores Educativos.
        </p>
    <h2 style="font-weight:bold;color:#e06666"><div style="text-align:center">{{$curso->nombre ?? "Curso"}}</div></h2>
    @if (isset($curso))
        
        @if ($curso->id == 41 && $country == 'ARG') 
        
            <p>
                
                <strong style="color:#B45F04;">-Kit de herramientas:</strong> 
                <a href="https://worknow-cursos.com/storage/temarios/Kitdeherramientas.pdf">Ver</a> 
            </p>
        @endif
        @if ((($curso->id == 37) || ($curso->id == 50) || ($curso->id == 34) || ($curso->id == 26)) && $country == 'ARG') 
            <p>
                <strong style="color:#B45F04;">-Kit de salud:</strong> 
                <a href="https://worknow-cursos.com/storage/temarios/KitSalud.pdf">Ver</a> 
            </p>
        @endif

    @endif
    <p>

        <strong style="color:#B45F04;">-Duración:</strong> Si bien la plataforma consta de una habilitación de 18 meses, 
        la duración del mismo depende <strong> pura y exclusivamente del alumno</strong>, así como 
        también, de sus tiempos. De igual manera en caso de brindarle 5 horas 
        semanales, éste estaría siendo terminado en un lapso de 6 a 8 meses 
        aproximadamente.
    </p>
    <p>

        <strong style="color:#B45F04;">-Aranceles:</strong> Nuestros aranceles son de <strong>12 cuotas de {{$country == 'ARG' ?'$ 1200':'U$D 30'}} regularmente.</strong> 
        Actualmente, con el <strong>descuento</strong> aplicado por su asesor educativo, puede elegir <strong>3 cursos</strong> y el 
        arancel será de <strong>tan sólo {{$country == 'ARG' ?'6 cuotas de $ 1200':'2 cuotas de U$D 50'}} finales.</strong>
        O puede optar por un <strong> unico pago de {{$country == 'ARG' ?'$ 3900':'U$D 100, pudiendolo abonar por Prex o PayPal'}}</strong>
    </p>
    <p>

        <strong style="color:#B45F04;">-Certificación:</strong> Esta misma esta regulada, avalada y certificada por la 
        <strong> cámara nacional de cursos a distancia,</strong> un ente privado donde se logra detectar cualquier 
        inconveniente con instituciones no reguladas o con material obsoleto e 
        ineficiente. Puede ingresar a su web y contactarse con ellos cuando 
        guste, su página web es: <a href="http://www.cndcd.com/">www.cncd.com.ar</a> 
    </p>
    <p>

        <strong style="color:#B45F04;">-Nuestro número de contacto:</strong> <strong>+54 9 11 2694 2226</strong> También puede utilizar 
        whatsapp por este número.
    </p>
    <p>   
        <strong style="color:#B45F04;">-Nuestra página web:</strong> www.worknowcursos.com
    </p>
    <p>   
        <strong style="color:#B45F04;">-Temario: </strong><a href="https://worknow-cursos.com{{ $curso->url_temario ?? '--'}}">Presione Aqui!</a>
    </p>
     <p>
         Desde ya muchas gracias por su atención, que tenga buenos días.
        </p>   
    </div>
</body>
</html>