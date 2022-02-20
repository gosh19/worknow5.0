<div class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
    <div class="relative">
        <img class="w-full max-h-48 rounded-xl" src="{{ $course->url_img }}" alt="{{ $course->nombre }}" />
        <p class="absolute top-0 bg-red-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
            Certificación oficial</p>
    </div>
    <h1 class="mt-4 text-gray-800 text-2xl font-bold cursor-pointer">{{ $course->nombre }}
    </h1>
    <div class="my-4">
        <div class="flex space-x-1 items-center p-1">
            <h1><i class="fas fa-certificate text-lightBlue-700"></i> Certificación oficial
            </h1>
        </div>
        <div class="flex space-x-1 items-center p-1">
            <h1><i class="fas fa-users text-lightBlue-700"></i>
                {{ $course->info->people == null ? rand(1500, 5000) : $course->info->people }}
                alumnos</h1>
        </div>
        <div class="flex space-x-1 items-center p-1">
            <h1><i class="fas fa-star text-lightBlue-700"></i>
                {{ $course->info->score == null ? rand(1500, 5000) : $course->info->score }}
            </h1>
        </div>
        <div class="mt-2 text-2xl font-semibold text-red-700">
            <h1>$ {{ number_format($course->info->getPrecio($country), 2, '.', ',') }}</h1>
        </div>
        <div class="text-md mt-2">
            <h1>Pago único</h1>
        </div>
        <div>
            <button wire:click="add" id="{{ $course->id }}"
                class="mt-4 text-xl w-full text-white  py-1.5 rounded-xl shadow-lg {{ $selected ? 'hover:bg-rose-700 bg-rose-600' : 'hover:bg-indigo-700 bg-indigo-600' }}">{{ $btnText }}
            </button>
        </div>

    </div>

</div>
