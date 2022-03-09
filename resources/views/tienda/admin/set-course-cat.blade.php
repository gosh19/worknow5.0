
<form action="{{route('Categoria.setCatCourse')}}" method="POST">
    @csrf

    <div class="grid grid-cols-4 w-full border p-3 gap-2">
        @foreach ($courses as $key => $course)
            <div class="col-span-1 p-2 justify-between border-2 border-red-900 rounded {{count($course->categorias) == 0 ? 'bg-red-500':'bg-green-500'}} font-bold text-white">
                <div class="flex justify-between">

                    <label for="">{{$course->nombre}}</label>
                    
                    <input type="checkbox" value="{{$course->id}}" name="course[{{$key}}]" id="{{$course->id}}">
                </div>
                <div class="flex justify-between">
                    @if ($course->info != null)
                        @if ($course->info->free)
                            <p class="font-bold text-red-600 p-2 bg-white rounded">GRATIS <i class="fab fa-free-code-camp fa-2x"></i></p>

                        @endif
                    @endif
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal-{{$course->id}}">
                        <i class="fas fa-plus-square"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <hr class="m-3">
    <div class="grid grid-cols-4 border p-3 gap-2">
        @foreach ($categorias as $key => $categoria)
        <div class="col-span-1 p-2 justify-between border-2 border-blue-900 rounded bg-blue-500 font-bold text-white">
            <div class="flex justify-between">

                <label for="">{{$categoria->name}}</label>
                <input type="checkbox" value="{{$categoria->id}}" name="categoria[{{$key}}]" id="{{$categoria->id}}">
            </div>
            
        </div>
        @endforeach
    </div>
    <hr class="m-3">
    <div class="w-full text-center">
        <input type="submit" value="Agregar" class="py-2 px-5 bg-orange-600 font-bold text-white rounded text-decoration-none hover:bg-orange-400">
    </div>
</form>
@foreach ($courses as $key => $course)

<!-- Modal -->
<div class="modal fade" id="Modal-{{$course->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="exampleModalLabel">{{$course->nombre}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>

                    <form action="{{route('Tienda.setCourseInfo',['course'=>$course])}}" class="grid grid-cols-1" method="post">
                        @csrf
                        <label for="">Valor peso</label>
                        <input type="text" class="p-2 border-2 text-black border-red-800 mb-2" name="peso" value="{{$course->info == null? null:$course->info->peso}}" placeholder="$ pesos argentinos" id="">
                        <label for="">Valor dolar</label>
                        <input type="text" class="p-2 border-2 text-black border-red-800 mb-2" name="dolar" value="{{$course->info == null? null:$course->info->dolar}}" placeholder="el verde ;)" id="">
                        <label for="">Descuento en porcentaje</label>
                        <input type="text" class="p-2 border-2 text-black border-red-800 mb-2" name="discount" value="{{$course->info == null? null:$course->info->discount}}" placeholder="porcentaje desc" id="">
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label class="text-black" for="">Descuento</label>
                                <input type="checkbox" name="on" {{$course->info == null? null:($course->info->on?'checked':null)}}><br>
                            </div>
                            <div>
                                <label class="text-black" for="">GRATIS</label>
                                <input type="checkbox" name="free" {{$course->info == null? null:($course->info->free?'checked':null)}}><br>
                            </div>
                        </div>
                        <label for="">Gente</label>
                        <input type="text" class="p-2 border-2 text-black border-red-800 mb-2" name="people" value="{{$course->info == null? null:$course->info->people}}" value="{{$course->info == null? rand(2500,5000):$course->info->people}}" id="">
                        <label for="">Score</label>
                        <input type="text" class="p-2 border-2 text-black border-red-800 mb-2" name="score" value="{{$course->info == null? null:$course->info->score}}" value="{{$course->info == null? (rand(400,500)/100):$course->info->score}}" id="">
                        <input type="submit" class="p-2 bg-red-900 rounded text-white" value="Cargar">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach