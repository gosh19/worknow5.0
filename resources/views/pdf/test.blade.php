<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <style>
        h1{
        text-align: center;
        text-transform: uppercase;
        }
        .contenido{
        font-size: 20px;
        }
        #primero{
        background-color: #ccc;
        }
        #segundo{
        color:#44a359;
        }
        #tercero{
        text-decoration:line-through;
        }
    </style>
    </head>
    <body>
        <h1>Titulo de prueba</h1>
        <hr>
        <div class="contenido">
            {{$data->name}}
            {{$data->email}}
            <div ><img src="{{ public_path('img/diploma/abajoder.png') }}" width="170" height="auto"></div>

        </div>
    </body>
</html>