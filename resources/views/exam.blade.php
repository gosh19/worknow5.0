@extends('layouts.app')

@section('exam')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-10">
              @for($i = 0; $i<count($questions); $i++)
              <div class="card">
                  <div class="card-header"><strong>Pregunta N° {{$i+1}}</strong></div>
                  <div class="card-body" id="presentacion" style="display:block;">
                    <div class="container">
                      <p class="text-center text-secondary" style="font-size: 30px;">{{$questions[$i]['pregunta']}}</p>
                      <div class="container">
                  <form class="" action="{{ route ('Exam.store') }}" method="POST">
                    <input type="hidden" value="{{$questions[0]['exam_id']}}" name="exam_id" />
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id" />
                    <input type="hidden" value="{{$unity_id}}" name="unity_id" />
                      @for($x = 0; $x<count($questions[$i]['answers']); $x++)
                        <div class="row justify-content-center">
                            @csrf
                            <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="radio" name="correcta[{{$i}}]" value="{{$questions[$i]['answers'][$x]['id']}}">
                                    </div>
                                  </div>
                                  <input readonly type="text" class="form-control" value="{{$questions[$i]['answers'][$x]['answer']}}">
                            </div>
                          </div>
                    @endfor
                   </div>
               </div>
            </div>

          </div><br>
                @endfor
                <div class="row justify-content-center">
                <input type="submit" class="btn btn-success" value="Confirmar y continuar"  />
                </form>
                </div>
              </div>
            </div>
          </div>
</div>

          <script type="text/javascript">
          $("#rendir").click(function() {
            $("#presentacion").hide("slow");
          });
          </script>


@endsection
