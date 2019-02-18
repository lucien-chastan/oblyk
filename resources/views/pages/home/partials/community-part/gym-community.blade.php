<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">home</i>@choice('home.new-gym', count($activity['gyms']))</div>
    <div class="collapsible-body">
        <div class="row">
            @foreach($activity['gyms'] as $gym)
                <div class="col s12 m6 l4 blue-border-activity-part">
                    <img class="left circle" src="{{ file_exists(storage_path('app/public/gyms/50/logo-' . $gym->id . '.png')) ? '/storage/gyms/50/logo-' . $gym->id . '.png' : '/img/icon-search-gym.svg' }}">
                    <a href="{{ $gym->url() }}">
                        {{ $gym->label }}
                    </a><br>
                    <span class="grey-text">
                        {{ $gym->big_city }}, {{ $gym->region }} ({{ $gym->code_country }})
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</li>