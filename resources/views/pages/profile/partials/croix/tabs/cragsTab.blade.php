<div class="blue-border-zone tickliste-zone">
    @foreach($crags as $key => $crosses)
        <div class="blue-border-div">
            <div class="row">
                @if($crosses[0]->route->crag->bandeau == '/img/default-crag-bandeau.jpg')
                    <img class="img-tick-list circle left" src="/img/default-crag-bandeau.jpg" height="40" width="40">
                @else
                    <img class="img-tick-list circle left" src="{{ str_replace_last('1300','50',$crosses[0]->route->crag->bandeau) }}">
                @endif
                <p class="no-margin">
                    <a class="text-bold" href="{{ $crosses[0]->route->crag->url() }}">{{ $crosses[0]->route->crag->label }}</a><br>
                    <span class="grey-text">@choice('pages/profile/crosses.crossesFigures', count($crosses))</span>
                </p>
            </div>

            @include('pages.profile.partials.croix.crosses')

        </div>
    @endforeach
</div>