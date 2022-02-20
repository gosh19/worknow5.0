<div>
    <div class="grid grid-cols-1 md:grid-cols-2 mb-3">
        <div class="row-start-3 md:row-start-1 row-span-2 md:row-end-3 p-2 m-2 border-2 md:h-full border-gray-700 text-white rounded">
            <h1 class="text-xl mb-2 text-red-900 font-bold">¡Agrega los cursos que mas te gusten y probalos de manera gratuita!</h1>
            <h1 class="text-black text-md mb-2">Solo apreta el boton <i class="fas fa-plus p-1 text-red-700 border-2 border-red-700 "></i> que se encuentra en cada curso mas abajo.</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 h-96 md:h-3/5 px-4">

                @for ($i = 0; $i < 3; $i++)
                    <div x-data="{texto:''}" 
                        @click="{texto = 'Agrega un curso mas abajo'}"
                        @click.away="{texto = ''}" 
                        class="col-span-1 h-full mb-3 overflow-hidden"
                    >
                        <p class="text-red font-bold mb-1 text-center z-50" x-text="texto"></p>
                        <div class="h-full border-4 {{!session()->has('selected.'.$i) ? '': 'border-green-700'}} shadow rounded flex justify-center"
                                style="
                                {{!session()->has('selected.'.$i) ? 'background: url('.asset("img/curso-".$i.".png").');': 'background-image: url('.(session('selected.'.$i.'.url_img') ?? null).');'}}
                                background-position: center;
                                background-repeat: no-repeat;
                                background-size: cover;
                                position: relative;
                                "
                            >
                            
                            <div class="align-self-center text-center w-full">   
                                <div 
                                    class="w-full absolute top-0 overflow-hidden h-full bg-red-700 bg-opacity-50"
                                >
                                    <p class="text-black  z-10 {{!session()->has('selected.'.$i) ?'fuente-kga hover: text-6xl':'text-xl font-bold text-white pt-3 '}}"
                                    >{{$i+1}}</p>
                                    <p>{{session()->has('selected.'.$i) ? session('selected.'.$i)->nombre:''}}</p>
                                </div>                          
                                <div class="absolute  bottom-1 md:bottom-4 w-full justify-self-auto ">
                                    @if (session()->has('selected.'.$i))
                                                                           
                                        <div wire:loading.remove>

                                            <button wire:click="deleteCourse({{$i}})" class="p-0 rounded-full  font-bold  hover:bg-black">
                                                <i class="far fa-times-circle fa-2x text-white hover:text-red-500 flex self-center justify-self-center"></i>
                                            </button>
                                        </div>
                                        <div wire:loading>

                                            <button class="p-0 rounded-full  font-bold  hover:bg-black" disabled>
                                                <i class="fas fa-spinner fa-2x text-red-500 animate-spin"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                    </div>
                @endfor

            </div>
        </div>
        <div class="row-start-1 md:row-start-1 row-span-2 md:row-end-3 h-full p-2 m-2 border-2 border-gray-700 rounded">
            <form class="grid grid-cols-1 gap-3 mb-3">
                <div>
                    <input wire:model="name" name="name" type="text" class="bg-gray-200 appearance-none border-2 border-red-600 rounded w-full py-3 px-4 text-black leading-tight focus:outline-none focus:bg-orange-300 focus:border-red-600" placeholder="Nombre completo" id="inline-full-name name" type="text">
                </div>
                <div>
                    <input wire:model="email" name="email" type="email" class="bg-gray-200 appearance-none border-2 border-red-600 rounded w-full py-3 px-4 text-black leading-tight focus:outline-none focus:bg-orange-300 focus:border-red-600" placeholder="E-mail" id="inline-full-name email" type="text">
                </div>
                <div>
                    <input wire:model="password" name="password" type="password" class="bg-gray-200 appearance-none border-2 border-red-600 rounded w-full py-3 px-4 text-black leading-tight focus:outline-none focus:bg-orange-300 focus:border-red-600" placeholder="Contraseña" id="inline-full-name password" type="text">
                </div>
                <div>
                    <input wire:model="confpassword" name="confirm-password" type="password" class="bg-gray-200 appearance-none border-2 border-red-600 rounded w-full py-3 px-4 text-black leading-tight focus:outline-none focus:bg-orange-300 focus:border-red-600" placeholder="Confirmar contraseña" id="inline-full-name" type="text">
                </div>
            </form>
            <div wire:loading.remove class="flex justify-center ">
                <button  class="p-2 border-2 bg-red-700 border-black font-bold text-white"
                        wire:click="register()"
                        onclick="gtag_report_conversion()"
                >REGISTRARME</button>
            </div>

            <div wire:loading class="w-full">
                <div class="flex justify-center ">
                    <button  class="p-2 border-2 bg-red-700 border-black font-bold text-white">
                        Cargando... <i class="fas fa-spinner animate-spin fa-1x"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
    <div wire:ignore>

    
        @foreach ($categorias as $cat)
            <div class="mx-3 mb-7">
            <h2 class="text-5xl font-bold text-orange-700">
                {{$cat->name}}
            </h2>
            <hr class="border-4 border-orange-600 mb-3">
            <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 gap-20">
                @foreach ($cat->courses as $curso)
                @livewire('inscripcion.curso',['curso'=> $curso,'country'=> $country] , key($curso->id))
            
                @endforeach
            </div>
            </div>
        @endforeach
    </div>
    <script>
        Livewire.on('campos', () =>{
            alert('Debe completar todos los campos');
        });
        Livewire.on('password', () =>{
            alert('Revise los campos de contraseñas y reescriba');
        });
        Livewire.on('cursos', () =>{
            alert('Debe seleccionar al menos un curso para probar');
        });
        Livewire.on('repetido', () =>{
            alert('Correo actualmente en uso, elija otro o contactese para recuperar la contraseña');
        });

        function gtag_report_conversion(url) {
            var callback = function () {
                if (typeof(url) != 'undefined') {
                window.location = url;
                }
            };
            gtag('event', 'conversion', {
                'send_to': 'AW-1001943045/ACHACI_xn64BEIXg4d0D',
                'event_callback': callback
            });
            return false;
        }
    </script>
</div>