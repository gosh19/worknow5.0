@extends('layouts.app')

@section('resultado')


  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-10">
            @if($notaTotal >= 70)
              <div class="alert alert-success text-center"><h3><string>APROBADO</string></h3></div>
            @else
              <div class="alert alert-danger text-center"><h3><string>DESAPROBADO</string></h3></div>
            @endif
              @for($i = 0; $i<count($questions); $i++)
              <div class="card">
                  <div class="card-header"><strong>Pregunta N° {{$i+1}}</strong></div>
                  <div class="card-body" id="presentacion" style="display:block;">
                    <div class="container">
                      <p class="text-center text-secondary" style="font-size: 30px;">{{$questions[$i]['pregunta']}}</p>
                      <div class="container">
                      @for($x = 0; $x<count($questions[$i]['answers']); $x++)
                        <div class="row justify-content-center">
                            <div class="input-group mb-3">
                              @if($questions[$i]['answers'][$x]['estado'] == 1)
                                  <input style="background: green; color:white" readonly type="text" class="form-control" value="{{$questions[$i]['answers'][$x]['answer']}}">
                              @endif
                              @if($questions[$i]['answers'][$x]['estado'] == 0)
                                  @for($y = 0; $y<count($answers); $y++)
                                    @if($questions[$i]['answers'][$x]['question_id'] == $answers[$y]['question_id'])
                                      @if($questions[$i]['answers'][$x]['answer'] == $answers[$y]['answer'])
                                        <input style="background:red; color:white;" readonly type="text" class="form-control" value="{{$answers[$y]['answer']}}" />
                                      @endif
                                    @endif
                                  @endfor
                              @endif

                            </div>
                          </div>
                    @endfor
                   </div>
               </div>
            </div>

          </div><br>
                @endfor
                <div class="row justify-content-center">
                <a href="{{ route('Unidad.index', ['id' => $unity_id]) }}">YA VI TODO AHORA QUIERO VOLVER A LA UNIDAD.</a>
                </form>
                </div>
              </div>
            </div>
          </div>
</div>

@endsection
