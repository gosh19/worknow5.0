<div x-data="{ openCat: true }" class="bg-white rounded-l-xl w-full">
    <div class="p-4">
      <h1 class="text-4xl text-blueGray-600 font-bold p-1">Registrate</h1>
      <h1 class="p-1 text-xl text-blueGray-600">y probá <b>gratis</b> los cursos que quieras!</h1>
    </div>

    <div class="px-3 py-2 grid grid-cols-1 md:grid-cols-2">
      <div class="col-span-1 p-3">
        <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" type="text" wire:model="email" placeholder="E-mail">
      </div>
      <div class="col-span-1 p-3">
        <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" type="password" wire:model="password" placeholder="Contraseña">
      </div>
      <div class="col-span-1 p-3">
          <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" type="text" wire:model="name" placeholder="Nombre completo">
      </div>
      <div class="col-span-1 p-3">
        <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" type="text" wire:model="phone" placeholder="Teléfono">
      </div>    
    </div>

    <div x-show="openCat" x-transition class="px-4 py-2">
        <h1 class="p-1 text-lg text-blueGray-600">¿Qué te gustaría aprender?</h1>
        <div class="flex w-full flex-wrap">

          @foreach ($categorias as $categoria)
            <div class="p-1 m-1 ">
              <div x-data="{open:false}">
                <button @click="open=!open" 
                        :class="open ? 'p-2 focus:outline-none text-white bg-blue-400 rounded-md shadow-inner':
                                'p-2 focus:outline-none text-blueGray-600 bg-blue-200 rounded-md shadow' "
                        wire:click="updateSelectedCat({{$categoria}})"
                >{{$categoria->name}}</button>
              </div>
            </div>
          @endforeach

        </div>
    </div>

    <div class="flex justify-end px-6 py-4">
      <button @click="openCat = ! openCat" x-show="openCat" class="p-2 flex items-center text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm font-semibold transform hover:scale-105 transition duration-500 focus:outline-none">
        Siguiente
        <i class="fas fa-angle-right font-semibold ml-1"></i>
      </button>
    </div>

    <div x-show="!openCat" x-transition class="px-4 py-2">
      <h1 x-show="openCat" class="p-1 text-lg text-blueGray-600">¿Qué te gustaría aprender?</h1>
      <h1 x-show="!openCat" class="p-1 text-lg text-blueGray-600">Elige los cursos que quieres probar</h1>
      <div class="flex w-full flex-wrap">
        @foreach ($selectedCat as $cat)

          @foreach ($cat['data'] as $course)
            <div class="p-1 m-1 ">
              <div x-data="{open:{{$course['selected']}}}">
                <button @click="open = !open" 
                        :class="open ? 'p-2 focus:outline-none text-white bg-blue-400 rounded-md shadow-inner':
                                'p-2 focus:outline-none text-blueGray-600 bg-blue-200 rounded-md shadow' "
                        wire:click="updateSelectedCourse({{$course['id']}})"
                        >{{$course['nombre']}}
                </button>
              </div>
            </div>
          @endforeach
        
        @endforeach
      </div>
    </div>

    <div class="flex justify-end px-6 py-4">
      <button wire:click="register" x-show="!openCat" class="p-2 flex items-center text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm font-semibold transform hover:scale-105 transition duration-500 focus:outline-none">
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
