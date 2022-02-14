@php
    $_16 = \App\Encuesta::where('opcion','16')->count();
    $_18 = \App\Encuesta::where('opcion','18')->count();
    $_no = \App\Encuesta::where('opcion','no')->count();
@endphp
<div class="card flotante mb-3">
    <div class="card-header cabecera-cboya text-white font-weight-bolder">
        CBOYITA ENTERTAIMENT
    </div>
    <ul class="list-group">
        <li class="list-group-item">16 a 18 : {{$_16}} </li>
        <li class="list-group-item">18 a 20 : {{$_18}} </li>
        <li class="list-group-item">No : {{$_no}} </li>
    </ul>
</div>

<style>
    .cabecera-cboya{
        background: rgba(255,94,102,1);
        background: -moz-linear-gradient(left, rgba(255,94,102,1) 0%, rgba(255,94,185,1) 16%, rgba(201,94,255,1) 34%, rgba(132,94,255,1) 49%, rgba(94,134,255,1) 65%, rgba(94,204,255,1) 77%, rgba(3,237,190,1) 89%, rgba(3,237,3,1) 100%);
        background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,94,102,1)), color-stop(16%, rgba(255,94,185,1)), color-stop(34%, rgba(201,94,255,1)), color-stop(49%, rgba(132,94,255,1)), color-stop(65%, rgba(94,134,255,1)), color-stop(77%, rgba(94,204,255,1)), color-stop(89%, rgba(3,237,190,1)), color-stop(100%, rgba(3,237,3,1)));
        background: -webkit-linear-gradient(left, rgba(255,94,102,1) 0%, rgba(255,94,185,1) 16%, rgba(201,94,255,1) 34%, rgba(132,94,255,1) 49%, rgba(94,134,255,1) 65%, rgba(94,204,255,1) 77%, rgba(3,237,190,1) 89%, rgba(3,237,3,1) 100%);
        background: -o-linear-gradient(left, rgba(255,94,102,1) 0%, rgba(255,94,185,1) 16%, rgba(201,94,255,1) 34%, rgba(132,94,255,1) 49%, rgba(94,134,255,1) 65%, rgba(94,204,255,1) 77%, rgba(3,237,190,1) 89%, rgba(3,237,3,1) 100%);
        background: -ms-linear-gradient(left, rgba(255,94,102,1) 0%, rgba(255,94,185,1) 16%, rgba(201,94,255,1) 34%, rgba(132,94,255,1) 49%, rgba(94,134,255,1) 65%, rgba(94,204,255,1) 77%, rgba(3,237,190,1) 89%, rgba(3,237,3,1) 100%);
        background: linear-gradient(to right, rgba(255,94,102,1) 0%, rgba(255,94,185,1) 16%, rgba(201,94,255,1) 34%, rgba(132,94,255,1) 49%, rgba(94,134,255,1) 65%, rgba(94,204,255,1) 77%, rgba(3,237,190,1) 89%, rgba(3,237,3,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff5e66', endColorstr='#03ed03', GradientType=1 );

        

    }
</style>