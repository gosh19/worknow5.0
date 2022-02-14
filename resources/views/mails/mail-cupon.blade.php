<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Mail informativo</title>
</head>
<body>
    <div style="border: 2px solid #3B0B0B; border-radius:40px;width:70%; margin:auto; padding: 20px; ">
        <div style="text-align:center"><span style="color:rgb(102,0,0);font-size:xx-large;font-family:Arial;font-weight:bold">Work Now Cursos</span></div>
        <div style="display:block; width:100%;margin-top:30px;margin-bottom:30px">
            <div style="margin:auto; width:220px;">

                <img src="https://worknow-cursos.com/confs/logo.png" width="220px" alt="worker-running-with-a-lot-of-documents_1012-192.jpg">
            </div>
        </div>
        <hr />
        <div style="display:block; margin:auto;text-align:center;font-family:Arial;">
            <p>Hola <strong>{{$nombre ?? "Nombre"}}</strong>! Cómo estás? Muchas gracias por interesarte en nuestras 
                capacitaciones.
            </p>
            <p style="margin-bottom: 60px;">Para poder acceder hoy mismo podes abonar con tarjeta de debito el siguiente cupon de pago</p>
            <a style="align-content: center; 
                        padding: 15px; 
                        background: #01A9DB;
                        border-radius: 10px; 
                        color:white !important;
                        text-decoration: none;" 
                href={{$url ?? '#'}}>
                Presione aqui</a>
                <hr style="margin-top:40px;"/>
            <p style="margin-top:40px;">Una vez abonado podra ingresar inmediatamente al curso de</p>
            <h2 style="font-weight:bold;color:#8A0808"><div style="text-align:center">{{str_replace('Test', '', $curso->nombre ?? "Curso") }}</div></h2>

        </div>
        <hr />
        <h3 style="text-align:center;font-family: Arial, Helvetica, sans-serif">Ante cualquier consulta puede dirigirse directamente a este correo <br> o via WhatsApp al <strong style="color:#088A08"> +54 9 11 2694-2226</strong></h3>
    </div>
</body>
</html>