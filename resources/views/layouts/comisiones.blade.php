@php
    $mesArray= array(
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
);
$hoy = \Carbon\Carbon::now();

$hoy->month = $hoy->month -2;
if ($hoy->month > 11) {
    $hoy->month = 11;
}
@endphp 

<div class="card mb-3 mt-3 w-100">
    <div class="card-header bg-danger font-weight-bold text-white">
        Tabla de comisiones mes de {{$mesArray[$hoy->month]}}
    </div>
    <div class="card-body">
        <div id="grafico_comisiones_mes">Loading...</div>
    </div>
</div>
