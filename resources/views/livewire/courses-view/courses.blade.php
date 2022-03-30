<div class="w-full">
    <div class="p-3 text-2xl ml-4 border-b-2">
        <h1>{{ $categoria->name }}</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 p-3 gap-4">
        @foreach ($courses as $key => $course)
            @livewire('inscripcion.curso', ['course' => $course, 'showModal'=>true], key($course->id))   
        @endforeach
    </div>
</div>
