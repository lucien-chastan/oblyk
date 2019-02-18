<div class="blue-border-zone tickliste-zone">
    @foreach($indoor['gyms'] as $key => $inCrosses)
        <div class="blue-border-div">
            <div class="row">
                <img class="img-tick-list circle left" src="{{ $inCrosses[0]->gym->logo(50) }}" height="40" width="40">
                <p class="no-margin">
                    <a class="text-bold" href="{{ $inCrosses[0]->gym->url() }}">{{ $inCrosses[0]->gym->label }}</a><br>
                    <span class="grey-text">@choice('pages/profile/crosses.crossesFigures', count($inCrosses))</span>
                </p>
            </div>

            @include('pages.profile.partials.croix.indoor-crosses')

        </div>
    @endforeach
</div>