    <div class="d-flex justify-content-center">
        <img src="{{ asset('img/Escritorio.png') }}" class="mb-3" width="200px" alt="">
    </div>
    <div class="alert alert-info">
        <h1 class="text-2xl mb-3">{{$practice->titulo}}</h1>
        <p>{{$practice->desc}}</p>
    </div>
    <div id="accordianId" class="mb-3" role="tablist" aria-multiselectable="true">
        @foreach ($practice->steps as $i => $step)
            
        
        <div class="card">
            <div class="card-header" role="tab" id="section{{$i}}HeaderId">
                <h5 class="mb-0 ">
                    <a class="text-lg text-blue-800 font-bold flex justify-between" data-bs-toggle="collapse" data-parent="#accordianId" href="#section{{$i}}ContentId" aria-expanded="true" aria-controls="section{{$i}}ContentId">
                       <p> Paso N° {{$i+1}} : {{$step->titulo}}</p>

                       <i class="fas fa-plus-square"></i>
                    </a>
                </h5>
            </div>
            <div id="section{{$i}}ContentId" class="collapse in" role="tabpanel" aria-labelledby="section{{$i}}HeaderId">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            {{$step->desc}}
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex justify-content-around">
                                @foreach ($step->imgs as $img)
                                    <img src="{{$img->url}}" width="200px">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
