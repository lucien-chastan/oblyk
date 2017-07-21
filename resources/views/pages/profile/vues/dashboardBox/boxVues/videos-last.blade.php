@foreach($videos as $video)
    <div class="col s12 l6">
        <div class="video-container">
            <iframe width="853" height="480" src="{{$video->iframe}}" allowfullscreen frameborder="0"></iframe>
        </div>
        <p class="i-cursor no-margin">
            {{$video->description}}<br>
            @if($video->viewable_type == 'App\Crag')
                posté sur <a href="{{route('cragPage',['crag_id'=>$video->viewable_id, 'crag_label'=>str_slug($video->viewable->label)])}}">{{$video->viewable->label}}</a> <br>
            @endif
            @if($video->viewable_type == 'App\Route')
                posté sur <a class="button-open-route" onclick="loadRoute({{$video->viewable_id}})">{{$video->viewable->label}}</a> <br>
            @endif
        </p>
    </div>
@endforeach