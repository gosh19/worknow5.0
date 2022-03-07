<div class="w-full">
    <div class="p-3 text-2xl ml-4 border-b-2">
        <h1>{{ $categoria->name }}</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 p-3 gap-4">
        @foreach ($courses as $key => $course)
            {{-- <div
                class="col-span-1 w-80 bg-white m-2 px-6 py-6 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
                <div class="relative">
                    <img class="w-full rounded-xl" src="{{ $course->url_img }}" alt="Colors" />
                    <p class="absolute top-0 bg-red-500 text-white font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg">
                        Certificación oficial</p>
                </div>
                <h1 class="mt-4 text-gray-800 text-xl font-bold cursor-pointer">{{ $course->nombre }}</h1>
                <button 
                        wire:click="$emit('asd',{{$course->id}})"
                    class="focus:outline-none mt-3 text-md w-40 text-white hover:bg-indigo-700 bg-indigo-600 py-1.5 rounded-xl shadow-lg"
                    >Ver
                    más</button>
            </div> --}}
            @livewire('inscripcion.curso', ['course' => $course, 'showModal'=>true], key($course->id))

            <div class="modal fade" id="modal-course-{{ $course['id'] }}" tabindex="-1"
                aria-labelledby="modal-course-{{ $course['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-course-{{ $course['id'] }}">{{ $course->nombre }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="aspect-w-16 aspect-h-9 mt-3">
                                @if ($course->videoMuestra)

                                    <iframe autoplay width="100%" height="300"
                                        src="{{ $course->videoMuestra->url }}" title="YouTube video player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                @else
                                    <img src="{{ $course->url_img }}" alt="" srcset="">
                                @endif
                            </div>
                            <div class="grid grid-cols-3 justify-center text-xl mt-3">
                                <div class="flex items-center col-span-1 justify-center">
                                    <p class="text-center "><i class="fas fa-certificate text-blue-700"></i> Certificación oficial
                                    </p>
                                </div>
                                <div class="flex items-center text-center col-span-1  justify-center" wire:ignore>
                                    <p><i class="fas fa-users text-red-500"></i>
                                        {{ $course->info->people == null ? rand(1500, 5000) : $course->info->people }}
                                        alumnos</p>
                                </div>
                                <div class="flex items-center text-center col-span-1  justify-center" wire:ignore>
                                    <p><i class="fas fa-star text-yellow-500"></i>
                                        {{ $course->info->score == null ? rand(1500, 5000) : $course->info->score }}
                                    </p>
                                </div>

                            </div>

                            <p class="leading-tight py-2 px-2 text-lg">
                                {!! $course->descripcion !!}
                            </p>
                            <div class="flex justify-end pt-2 text-lg font-semibold">
                                <a href="{{ route('inscripcionTemprana') }}"
                                    class="outline-none bg-indigo-600 rounded-xl text-center text-white hover:bg-indigo-700 py-1.5 w-40">Ir
                                    al registro</a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach



    </div>

    <script>
        Livewire.on('selectCourse', () => {
            console.log('asd');
        })
    </script>

</div>
