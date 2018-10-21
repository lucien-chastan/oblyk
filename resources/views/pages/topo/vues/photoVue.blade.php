<div class="row">
    <div class="col s12">
        <div class="card-panel guidebook-photo-list">

            @if(count($crags) > 0)
                @foreach($crags as $crag)
                    @php($photos = $crag->AllPhoto())
                    <h2>
                        <a class="loved-king-font" href="{{ $crag->url() }}">{{ $crag->label }}</a>
                        <span class="grey-text nb-photo">@choice('pages/guidebooks/tabs/photos.nbPhotos', count($photos))</span>
                    </h2>
                    @include('includes.gallery')
                @endforeach
            @else
                <p class="grey-text text-center">@lang('pages/guidebooks/tabs/photos.noPhoto')</p>
            @endif

        </div>
    </div>
</div>