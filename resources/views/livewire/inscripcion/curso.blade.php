<div class="col-span-1">
    <div class="relative shadow {{$selected ? 'bg-green-400':''}}">
      <div class="h-40 " 
          style="background-image: url('{{$course->url_img}}');
                  background-position: center;
                  background-repeat: no-repeat;
                  background-size: cover;
                  position: relative;"
      >
        @if ($course->info != null)
          @if ($course->info->on && ($course->info->discount != null)&&(!$course->info->free))                               
            <div class="absolute right-3 top-3">
              <p class=" bg-red-800 py-1 px-2 text-white font-extrabold">
                {{$course->info->discount}}% Off
              </p>
            </div>
          @else 
            @if ($course->info->free)
                
            <div class="absolute right-3 top-3">
              <p class=" bg-red-800 py-1 px-2 text-white font-extrabold">
                GRATIS
              </p>
            </div>
            @endif
          @endif
        @endif
      </div>
      <div class="border-4 border-red-800"></div>
      <div class="p-3">

        <h2 class="text-xl font-bold mb-3">{{$course->nombre}}</h2>
        <div wire:ignore class="grid grid-cols-2 mb-3">
          <div class="col-span-1">
            <h5 class="text-md text-gray-500 mb-4">Certificacion oficial <i class="fas fa-certificate text-blue-500"></i></h5>
            <div class="flex">
              <p class="text-md text-gray-600 mr-4 flex-1 self-end"><i class="fas fa-user-friends text-red-900"></i>{{$course->info == null ? rand(1500,5000):($course->info->people == null?rand(1500,5000): $course->info->people)}}</p>
              <p class="text-md text-gray-600 flex-1 self-end"><i class="fas fa-star text-yellow-400"></i>{{$course->info == null ? '4.'.rand(10,99):($course->info->score == null? '4.'.rand(10,99):$course->info->score)}}</p>
            </div>
          </div>
          <div class="col-span-1 text-right flex">

            <div class="text-md text-gray-600 flex-1 self-end">
              <div>

                @if ($course->info != null)
                  @if (($course->info->on && ($course->info->discount != null))||($course->info->free))
                  
                    <s class="text-md text-gray-500 font-bold"> $ {{(($country == 'AR')||($country == 'ARG'))?$course->info->peso:($country == 'PY' ?number_format(($course->info->dolar*(session('conversion')?? 7045)),2,',','.'):$course->info->dolar)}} {{(($country == 'AR')||($country == 'ARG'))? 'ARS':($country == 'PY' ?'PYG':'USD')}}</s>
                  @endif
                @endif
              </div>
              <p class="text-xl text-orange-700 ">
                <strong>
                  {{$country == 'PY'? 'G':'$'}}

                    @if ($course->info != null)
                    {{number_format($course->info->getPrecio($country),2,',','.')}}
                    @else
                    {{(($country == 'AR')||($country == 'ARG'))? 1989:($country == 'PY' ?number_format((23*(session('conversion')?? 7045)),2,',','.'):23)}}
                    @endif
                    {{(($country == 'AR')||($country == 'ARG'))? 'ARS':($country == 'PY' ?'PYG':'USD')}}
                </strong>
              </p>
              <p >Pago <strong>Unico</strong></p>
            </div>
          </div>
        </div>
        <hr class="mb-3">
        <div class="flex ">
            @if (!$selected)
            <button wire:click="add()" class="py-1 px-2 mr-2 border-2 border-red-700 hover:bg-red-700 text-red-700 hover:text-white transition-all duration-500" ><i class="fas fa-plus "></i></button>
            
            @else
            <button wire:click="add()" class="py-1 px-2 mr-2 border-2 border-green-700 hover:bg-green-700 text-green-700 hover:text-white transition-all duration-500" ><i class="fas fa-check"></i></button>
            @endif
          <a class="py-1 bg-gray-200 px-2 border-2 text-decoration-none border-red-700 text-red-700 hover:bg-red-700 hover:text-white transition-all duration-500 w-full font-bold text-center" 
            href="{{route('Intro.ShowCourse',['Course'=> $course])}}">Ver mas</a>

        </div>
      </div>
    </div>
  </div>
