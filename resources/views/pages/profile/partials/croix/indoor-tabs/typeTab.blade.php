<div class="blue-border-zone tickliste-zone">
    @foreach($indoor['types'] as $key => $inCrosses)
        <div class="blue-border-div">
            <div class="row">
                <span style="font-size: 1.8em" class="loved-king-font label-legend-climb">@lang('elements/climb-gyms.climb_'.$key)</span>
                <span class="grey-text">@choice('pages/profile/crosses.crossesFigures', count($inCrosses))</span>
            </div>

            @include('pages.profile.partials.croix.indoor-crosses')

        </div>
    @endforeach
</div>