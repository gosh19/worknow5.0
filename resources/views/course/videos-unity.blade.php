<div class="accordion w-100" id="accordionVideosYT">
    @php
        $i = 0;
    @endphp
    @foreach ($unity->videosYT as $i => $video)
        <div class="card tarjeta-video">
            <div class="card-header " id="heading{{ $video->id }}">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-white font-weight-bold" 
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseVideo-{{$video->id}}" aria-expanded="false" aria-controls="collapseVideo-{{$video->id}}"
                            {{-- 
                                
                                type="button"
                                data-toggle="collapse" data-target="#collapse-{{ $video->id }}" aria-expanded="true"
                                aria-controls="collapse-{{ $video->id }}">
                                --}}
                                >
                                <div class="d-flex justify-content-between">
                                    
                                    <h5 class="text-lg">{{ $video->titulo }}</h5>
                                    <h5>
                                        
                                        <span class="badge badge-dark">+</span>
                                    </h5>
                        </div>
                    </button>
                </h2>
            </div>

            <div id="collapseVideo-{{$video->id}}" class="collapse p-3 caja-video"
                aria-labelledby="heading{{ $video->id }}" data-parent="#accordionVideosYT">
                <h1 class="text-4xl">{{ $video->titulo }}</h1>

                <h5 class="text-2x1 mb-3">{{ $video->subtitulo }}</h5>
                <div class="row justify-content-center">
                    <iframe width="560" height="315" src={{ $video->html }} frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($unity->videos as $video)
        @php
            $i++;
        @endphp
        <div class="card tarjeta-video">
            <div class="card-header " id="heading{{ $video->id + 15 }}">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left text-white font-weight-bold" type="button"
                        data-toggle="collapse" data-target="#collapse-{{ $video->id + 15 }}" aria-expanded="true"
                        aria-controls="collapse-{{ $video->id + 15 }}">
                        <div class="d-flex justify-content-between">

                            <h5>Video N° {{ $i }}</h5>
                            <h5>
                                <span class="badge badge-dark">+</span>
                            </h5>
                        </div>
                    </button>
                </h2>
            </div>

            <div id="collapse-{{ $video->id + 15 }}" class="collapse p-3 caja-video"
                aria-labelledby="heading{{ $video->id + 15 }}" data-parent="#accordionVideosYT">
                <h1 class="text-center"><u> {{ $video->titulo }}</u></h1>

                <h5 class="text-center ">{{ $video->subtitulo }}</h5>
                <div class="row justify-content-center">
                    <video id="my-video" class="video-js" controls preload="auto" width="100%" height="300"
                        data-setup="{}">
                        <source src="{{ $video->url }}" type='video/mp4'>
                    </video>
                </div>
            </div>
        </div>
    @endforeach

</div>
