<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">videocam</i>@choice('home.new-video', count($activity['videos']))</div>
    <div class="collapsible-body">
        <div class="row">
            @foreach($activity['videos'] as $video)
                <div class="col s12 m6 l4">
                    <p class="video-title">
                        <a href="{{ $video->getTargetLink()['link'] }}">{{ $video->getTargetLink()['name'] }}</a>
                    </p>
                    <div class="video-container">
                        <iframe width="853" height="480" src="{{$video->iframe}}" allowfullscreen frameborder="0"></iframe>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</li>