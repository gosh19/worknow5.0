@if ($user->datosUser != null)
  <div class="p-2 bg-blue-400 font-bold">
    <p class="text-xl">{{$user->datosUser->country}}</p>
  </div>
@endif