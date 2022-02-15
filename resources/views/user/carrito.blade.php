@if (Auth::check())
@if ($carrito)

    <div class="mb-3 py-2 bg-gradient-to-br from-red-600 to-red-300 shadow-2xl">
      <div class=" py-2 px-3  text-white">
        <a class="flex justify-between text-decoration-none hover:text-black transition-all duration-500" data-toggle="collapse" href="#collapseCarrito" role="button" aria-expanded="true" >
          <p class="text-lg font-extrabold tracking-wider">Carrito de cursos <span class="bg-gray-700 p-1 rounded-full">{{count(Auth::user()->courses)}}</span></p>
          <p class="text-right  mb-2"><i class="fas fa-cart-arrow-down fa-2x"></i></p>
        </a>
      </div>
      <div class="collapsee" id="collapseCarrito">
      <div class="mb-3">
        @php
            $total = 0;
            $cant = 0;
            $auxTotal = 0; //ESTE ES EL VALOR DE LA SUMA TOTAL, EL OTRO VARIA DEPENDE LA PROMO
            $hasDescuento = false; //para saber si tiene descuento o no
        @endphp
        @foreach (Auth::user()->courses as $key => $course)
          @if ($course->pivot->type == 'test')
            <hr class="w-full border-2 border-black">
            <div style="background-image: url('{{$course->url_img}}');
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        position: relative;"
            >

              <div class="py-2 px-3 bg-gray-700 bg-opacity-75 w-full flex justify-between">
                <div class="flex">
                  <a class="mr-2 rounded-full bg-white  w-5 h-5" href="{{route('Curso.baja',['user_id'=>Auth::id(),'course_id'=>$course->id])}}"><i class="fas fa-minus-circle text-xl text-red-500 "></i></a>
                  <p class="font-bold text-white tracking-widest">
                    {{$course->nombre}}
                  </p>
                </div>
                <div>
                  <p class="py-1 font-bold text-white w-28 text-right">
                    $ {{$course->info == null?($country == 'AR'?1989:23):$course->info->getPrecio($country)}} {{$country == 'AR'?'ARS':'USD'}}
                  </p>
                </div>
              </div>
              @php
                $cant++;
                $total += $course->info == null?($country == 'AR'?1989:23):$course->info->getPrecio($country);
                if ($cant == 3) {
                  $total = $total * 0.33;
                  $hasDescuento = true;
                }
                $auxTotal += $course->info == null?($country == 'AR'?1989:23):$course->info->getPrecio($country);
              @endphp
            </div>
          @endif
          @if ($loop->last)
            <hr class="w-full border-2 border-black">
          @endif
        @endforeach
        @if (($key >= 2)&&($hasDescuento))
            
          <hr class="w-full border-2 border-black">
          <div style="background-image: url('{{asset('img/curso-0')}}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;"
          >

            <div class="py-2 px-1 bg-red-700 bg-opacity-75 flex justify-between"
            
            >
            
              <p class="font-bold text-white ml-3 tracking-widest">Descuento promocion 3 cursos</p>
              <p class="py-1 font-bold text-white ">- $ {{($auxTotal-$total)}} {{$country == 'AR'?'ARS':'USD'}}</p>
            </div>
          </div>
          <hr class="w-full border-2 border-black">
        @endif
        <div class="flex justify-end bg-red-600 p-1 font-bold text-white">
          <p class="tracking-widest">TOTAL : $ {{$total}} {{$country == 'AR'?'ARS':'USD'}}</p>
        </div>
      </div>
      <div class="w-full">
        @if ($country == 'AR')
            
            <a href="{{route('Mp.pay')}}" 
            class="py-2 px-5 block bg-blue-600 border-2 text-center border-blue-900 rounded font-bold text-white text-decoration-none hover:bg-blue-500 transition-all duration-300"
            >Abonar inscripcion con MercadoPago</a>
        @else
            <a href="{{route('PayPal.pay')}}" 
            class="block text-center py-2 px-5 bg-blue-600  font-bold text-white text-decoration-none hover:bg-blue-500 transition-all duration-300"
            >Abonar inscripcion con PayPal <i class="fab fa-paypal"></i></a>
        @endif
      </div>
      </div>
    </div>
@endif

@endif