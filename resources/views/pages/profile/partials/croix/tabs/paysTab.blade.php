<div class="blue-border-zone tickliste-zone">
    @foreach($pays as $key => $crosses)
        <div class="blue-border-div">
            <div class="row">
                <p class="no-margin">
                    <span style="font-size: 1.8em" class="loved-king-font">{{ $key }}</span> <span class="grey-text">@choice('pages/profile/crosses.crossesFigures', count($crosses))</span>
                </p>
            </div>

            @include('pages.profile.partials.croix.crosses')

        </div>
    @endforeach
</div>