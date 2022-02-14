<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Mail informativo</title>
</head>
<body>
    <div style="border: 2px solid #3B0B0B; border-radius:40px;width:70%; margin:auto; padding: 20px; ">
        <div style="text-align:center"><span style="font-family:Lalezar; color:#F50E1C; text-align: center; font-size: 50px">Work Now Cursos</span></div>
        <div style="display:block; width:100%;margin-top:30px;margin-bottom:30px">
            <div style="margin:auto; width:220px;">

                <img src="https://worknow-cursos.com/img/megafono.jpg" width="220px" alt="worker-running-with-a-lot-of-documents_1012-192.jpg">
            </div>
        </div>
        <div style="background:#F50E1C;height:5px;"></div>
        <div style="display:block; margin:auto;text-align:center;font-family:Arial;">
            <p>Hola <strong>{{$name ?? "Nombre"}}</strong>! Cómo estás? </p>

            <p style="margin-bottom: 60px;">{{$msj ?? 'TCT'}}</p>


        </div>
        <div style="background:#F50E1C;height:5px;"></div>
        <h3 style="text-align:center;font-family: Arial, Helvetica, sans-serif">Ante cualquier consulta puede dirigirse directamente a este correo <br> o via WhatsApp al <strong style="color:#088A08"> +54 9 11 2694-2226</strong></h3>
    </div>
</body>
</html>