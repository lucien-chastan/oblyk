<div id="information-slide" class="side-nav">
    <div class="information-area">
        <table class="information-table">
            <tbody>
            <tr>
                <th><i class="material-icons">reorder</i></th>
                <td>
                    @if($photo->description)
                        {{ $photo->description}}
                    @else
                        <span class="grey-text">
                            @lang('pages/gallery/gallery.noDescription')
                        </span>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>

        <p class="information-title"><i class="material-icons left">account_circle</i>@lang('pages/gallery/gallery.addBy')</p>
        <a href="{{ $photo->user->url() }}">
            <img class="left user-picture" src="{{ $photo->user->picture() }}">
            {{ $photo->user->name }}
        </a>

        <p class="information-title"><i class="material-icons left">terrain</i>
            @lang('pages/gallery/gallery.addOn')
            @if($photo->illustrable_type === 'App\\Crag')
                @lang('pages/gallery/gallery.addOnCrag')
            @elseif($photo->illustrable_type === 'App\\Sector')
                @lang('pages/gallery/gallery.addOnSector')
            @elseif($photo->illustrable_type === 'App\\Route')
                @lang('pages/gallery/gallery.addOnRoute')
            @endif
        </p>
        <a href="{{ $element->url() }}">
            <img class="left user-picture" src="{{ $element->cover() }}">
            {{ $element->label }}
        </a>

        <p class="information-title small" title="@lang('pages/gallery/gallery.titleAdditionDate')"><i class="material-icons left">today</i>{{ $photo->created_at->format('d/m/Y')  }}</p>

        <p class="information-title small" title="@lang('pages/gallery/gallery.titlePlace')"><i class="material-icons left">pin_drop</i>
            <a class="map-link" href="{{ route('map') }}#{{ $photo->lat }}/{{ $photo->lng }}/14">
                {{ $photo->lat }}, {{ $photo->lng }}
            </a>
        </p>

        @if($photo->source)
            <p class="information-title small" title="@lang('pages/gallery/gallery.titleSource')"><i class="material-icons left">link</i> {{ $photo->source }}</p>
        @endif

        <p class="information-title small" title="Copyright"><i class="material-icons left">copyright</i>
            {{ $photo->getCreative() }}
        </p>

        @if($photo->exif_model || $photo->exif_make)
            <p class="information-title small" title="@lang('pages/gallery/gallery.titleMakeModel')"><i class="material-icons left">photo_camera</i>{{ $photo->exif_make }} {{ str_replace($photo->exif_make, '', $photo->exif_model) }}</p>
        @endif

        <div class="gallery-map" id="gallery-map"></div>
        <input type="hidden" value="{{ $photo->lat }}" id="photo-lat">
        <input type="hidden" value="{{ $photo->lng }}" id="photo-lng">
    </div>
</div>