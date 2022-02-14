@extends('layouts.app')

@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pendientes</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Otros</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#kitTypes" role="tab" aria-controls="kitTypes" aria-selected="false">Tipos de kits</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="alert alert-danger">
            <h3>Tabla de pendientes</h3>
            <p>Kits aun sin informacion</p>
        </div>
        
        @include('kit.tabla-kits',['kits' => $kitsPend])
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="alert alert-info">
            <h3>Otros</h3>
        </div>
        
        @include('kit.tabla-kits',['kits' => $kitsGen])
    </div>
    <div class="tab-pane fade" id="kitTypes" role="tabpanel" aria-labelledby="profile-tab">
        <div class="alert alert-info">
            <h3>Tipos de kits</h3>
        </div>
        
        @include('kit.kit-types',['kitsTypes' => $kitTypes])
    </div>
</div>

@endsection
