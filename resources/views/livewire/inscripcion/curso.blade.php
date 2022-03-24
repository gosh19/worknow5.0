<div class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
    <div class="relative">
        <img class="w-full max-h-48 rounded-xl" src="{{ $course->url_img }}" alt="{{ $course->nombre }}" 
        data-bs-toggle="modal"
        data-bs-target="#modal-course-{{ $course['id'] }}"
        />
        <p class="absolute top-0 bg-red-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
            Certificación oficial</p>

    </div>
    <p class="mt-4  cursor-pointer"
        data-bs-toggle="modal"
        data-bs-target="#modal-course-{{ $course['id'] }}"
    >
        <span class="text-gray-800 text-2xl font-bold">{{ $course->nombre }}</span>
        @if (\Request::route()->getName() == 'Intro.Cursos') 
        <span>
            -
            <i class="fa-solid fa-maximize ml-1 text-purple-600"></i>
        </span>
        @endif
    </p>
    <div class="my-4">
        <div class="flex items-center">
            <p><i class="fas fa-certificate text-blue-700"></i> Certificación oficial
            </p>
        </div>
        <div class="flex items-center" wire:ignore>
            <p><i class="fas fa-users text-red-500"></i>
                {{ $course->info->people == null ? rand(1500, 5000) : $course->info->people }}
                alumnos</p>
        </div>
        <div class="flex items-center" wire:ignore>
            <p><i class="fas fa-star text-yellow-500"></i>
                {{ $course->info->score == null ? rand(1500, 5000) : $course->info->score }}
            </p>
        </div>
        <hr class="my-1">
        <div class="mt-2 text-2xl font-semibold text-red-700">
            <p>${{session('country')}} {{ number_format($course->info->getPrecio($country), 2, '.', ',') }}</p>
        </div>
        <div class="text-md mt-2">
            <p>Pago único</p>
        </div>
        <div>
            <button wire:click="add({{\Request::route()->getName() == 'User.selectCourses'}})" id="{{ $course->id }}"
                class="mt-4 text-xl w-full text-white  py-1.5 rounded-xl shadow-lg {{ $selected ? 'hover:bg-red-800 bg-red-800' : 'hover:bg-indigo-700 bg-indigo-600' }}">{{ $btnText }}
            </button>
        </div>

    </div>

</div>
