<div class="w-full">
    <div class="p-3 text-2xl ml-4 border-b-2">
        <h1>{{ $categoria->name }}</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 p-3">

        @foreach ($courses as $key => $course)

            <div
                class="col-span-1 w-80 bg-white m-2 px-6 py-6 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
                <div class="relative">
                    <img class="w-full rounded-xl" src="{{ $course->url_img }}" alt="Colors" />
                    <p class="absolute top-0 bg-red-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
                        Certificación oficial</p>
                </div>
                <h1 class="mt-4 text-gray-800 text-xl font-bold cursor-pointer">{{ $course->nombre }}</h1>
                <button 
                        wire:click="$emitUp('selectCourse',{{$course}})"
                    class="focus:outline-none mt-3 text-md w-40 text-white hover:bg-indigo-700 bg-indigo-600 py-1.5 rounded-xl shadow-lg"
                    >Ver
                    más</button>
            </div>
        @endforeach



    </div>

    

</div>
