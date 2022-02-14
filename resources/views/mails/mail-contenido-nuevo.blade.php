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

                <img src="https://worknow-cursos.com/img/idea.jpg" width="220px" alt="worker-running-with-a-lot-of-documents_1012-192.jpg">
            </div>
        </div>
        <hr />
        <div style="display:block; margin:auto;text-align:center;font-family:Arial;">
            <h3>Hola <strong>{{$nombre ?? ""}}</strong>! Cómo estás? </h3>
            <h4>¡Tenes material nuevo para revisar!</h4>
            <p style="margin-bottom: 60px;">{{$texto ?? ""}}</p>
            <p>Este contenido lo encontraras en la unidad <h2 style="color:#DF0101;" > <strong> {{$unity->nombre ?? "#"}}</strong></h2></p>
            <a style="align-content: center; 
                        padding: 15px; 
                        background: #01A9DB;
                        border-radius: 10px; 
                        color:white !important;
                        text-decoration: none;" 
                href={{$url ?? 'https://worknow-cursos.com'}}>
                Ir al contenido</a>
                <hr style="margin-top:40px;"/>
            <p style="margin-top:40px;">
                Cualquier consulta recuerden consultar por whatsapp 
                <span><img src="https://worknow-cursos.com/img/whatsapp.png" height="30px" alt=""></span>
            </p>
            <h2 style="font-weight:bold;color:#DF0101"><div style="text-align:center">Aprender para emprender!</div></h2>

        </div>
    </div>
</body>
</html>