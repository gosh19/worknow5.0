
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">

        <div class="panel-heading">
            <form class="form-inline" action={{route('youtube.search')}} method="post">
              @csrf

            <div class="form-group">
                <input type="text" name="search" value="" class="form-control">
                <button type="submit" class="btn btn-default">Buscar</button>
            </div>


          </form>
        </div>
        <div class="panel-body">

        </div>
    </div>
</div>
@endsection
