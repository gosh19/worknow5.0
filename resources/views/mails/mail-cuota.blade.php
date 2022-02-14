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
            <p>Hola <strong>{{$user->name ?? "Nombre"}}</strong>! Cómo estás? Esperamos que te este yendo bien con tu capacitacion
            </p>
            <p>Te dejamos a continuacion el cupon de pago de la cuota mensual. </p>
            <p >Recorda que podes abonarlo utilizando todos los medios de pago a traves de <strong style="color:#0489B1 "> mercadopago.</strong>
            </p>
            <div style="margin-bottom: 60px;">

                <img width="100px" src="https://lh3.googleusercontent.com/proxy/eyDJ0ta3gaSSNhj-mFo8Hli-Zz7Wssxi8_3hgFkfbYw9dqfRMLSAvGsGCOASGNqWYtUmAqGHvh9GkyRcBy3OIATAMT0a7EKVSjoqb90Jbl7qh2-ZJw" alt="">
            </div>
            
            <a style="align-content: center; 
                        padding: 15px; 
                        background: #01A9DB;
                        border-radius: 10px; 
                        color:white !important;
                        text-decoration: none;" 
                href={{$url ?? '#'}}>
                Presione aqui </a>
                <hr style="margin-top:40px;"/>
            <p style="margin-top:40px;">Recuerde que de no ser abonado antes del {{date_format($fecha, 'd-m-Y')}} se <strong>restringira</strong> el acceso a la plataforma.</p>
            <p>En caso de necesitar una prorroga contactarse con su profesor a cargo para evaluar la situacion.</p>
        </div>
        <hr />
        <h3 style="text-align:center;font-family: Arial, Helvetica, sans-serif">Ante cualquier consulta puede dirigirse directamente a este correo <br> o via WhatsApp al <strong style="color:#088A08"> +54 9 11 2694-2226</strong></h3>
    </div>
</body>
</html>