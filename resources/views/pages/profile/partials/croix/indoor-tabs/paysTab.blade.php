<div class="blue-border-zone tickliste-zone">
    @foreach($indoor['pays'] as $key => $inCrosses)
        <div class="blue-border-div">
            <div class="row">
                <p class="no-margin">
                    <span style="font-size: 1.8em" class="loved-king-font">{{ $key }}</span> <span class="grey-text">@choice('pages/profile/crosses.crossesFigures', count($inCrosses))</span>
                </p>
            </div>

            @include('pages.profile.partials.croix.indoor-crosses')

        </div>
    @endforeach
</div>