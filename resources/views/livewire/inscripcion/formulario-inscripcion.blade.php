<div  class="bg-white rounded-l-xl w-full">
    <div class="p-4">
      <h1 class="text-4xl text-blueGray-600 font-bold p-1">Registrate</h1>
      <h1 class="p-1 text-xl text-blueGray-600">y probá <b>gratis</b> los cursos que quieras!</h1>
    </div>
    <div class="px-3 py-2 grid grid-cols-1 md:grid-cols-2">
      <div class="col-span-1 p-3">
        <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" type="text" wire:model="email" placeholder="E-mail">
        @if ($errorFields['email'])<span><small class="text-red-500">Campo obligatorio</small></span>@endif
      </div>
      <div class="col-span-1 p-3">
        <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" type="password" wire:model="password" placeholder="Contraseña">
        @if ($errorFields['password'])<span><small class="text-red-500">Campo obligatorio</small></span>@endif
      </div>
      <div class="col-span-1 p-3">
          <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" type="text" wire:model="name" placeholder="Nombre completo">
          @if ($errorFields['name'])<span><small class="text-red-500">Campo obligatorio</small></span>@endif
      </div>
      <div class="col-span-1 p-3">
        <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" type="text" wire:model="phone" placeholder="Teléfono">
        @if ($errorFields['phone'])<span><small class="text-red-500">Campo obligatorio</small></span>@endif
      </div>    
    </div>


    <div class="px-4 py-2">
      <h1 class="p-1 text-lg text-blueGray-600">Elige los cursos que quieres probar</h1>
      <div class="flex w-full flex-wrap">
        @foreach ($allCourses as $key => $course)

            <div class="p-1 m-1 ">
              <div>
                <button
                        class="p-2 focus:outline-none  rounded-md shadow-inner {{$isSelected[$key]?' text-white bg-blue-400':'text-blueGray-600 bg-blue-200'}}"
                        wire:click="updateSelectedCourse({{$key}})"
                        >{{$course['nombre']}}
                </button>

              </div>
            </div>

        
        @endforeach
      </div>
    </div>

    <div class="flex justify-end px-6 py-3">

      <button wire:click="register" class="p-2 flex items-center text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm font-semibold transform hover:scale-105 transition duration-500 focus:outline-none">
        Registrarme
        <i class="fas fa-angle-right font-semibold ml-1"></i>
      </button>
    </div>
    
    <script>
      Livewire.on('repetido', () =>{
            alert('Correo actualmente en uso, elija otro o contactese para recuperar la contraseña');
        });
    </script>
</div>
