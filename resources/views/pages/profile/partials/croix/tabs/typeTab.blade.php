<div class="blue-border-zone tickliste-zone">
    @foreach($types as $key => $crosses)
        <div class="blue-border-div">
            <div class="row">
                <span style="font-size: 1.8em" class="loved-king-font label-legend-climb">@lang('elements/climbs.climb_'.$key)</span>
                <span class="grey-text">@choice('pages/profile/crosses.crossesFigures', count($crosses))</span>
            </div>

            @include('pages.profile.partials.croix.crosses')

        </div>
    @endforeach
</div>
