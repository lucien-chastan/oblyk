@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <li>
        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
            <img class="flag-icon" src="/img/flag_{{ $localeCode }}.jpg"> {{ $properties['native'] }}
        </a>
    </li>
@endforeach