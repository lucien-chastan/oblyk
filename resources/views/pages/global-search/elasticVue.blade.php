@foreach($finds as $find)


    {{--RÉSULTAT SUR LE LEXIQUE--}}
    @if($type == 'words')
        <div class="col s12 blue-border-search rideau-animation">
            <a class="text-bold">{{ $find->label }}</a>
            <div class="markdownZone">
                @markdown($find->definition)
            </div>
        </div>
    @endif

    {{--RÉSULTAT SUR LES FALAISE--}}
    @if($type == 'crags')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ ($find->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $find->bandeau) }}">
            <a href="{{ \App\Crag::webUrl($find->id, $find->label) }}">
                <img src="/img/point-{{ $find->type_voie . $find->type_grande_voie . $find->type_bloc . $find->type_deep_water . $find->type_via_ferrata }}.svg" class="search-climb-type">
                {{ $find->label }}
            </a><br>
            <span class="grey-text">
                {{ $find->region }} ({{ $find->code_country }})
            </span>
        </div>
    @endif

    {{--RÉSULTAT SUR LES USERS--}}
    @if($type == 'users')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ file_exists(storage_path('app/public/users/100/user-' . $find->id . '.jpg')) ? '/storage/users/100/user-' . $find->id . '.jpg' : '/img/icon-search-user.svg' }}">
            <a href="{{ \App\User::webUrl($find->id, $find->name) }}">
                {{ $find->name }}
            </a><br>
            <span class="grey-text">
                @lang('elements/sex.sex_' . $find->sex),
                {{ $find->birth != 0 ? trans_choice('elements/old.old', date('Y') - $find->birth) : trans_choice('elements/old.old',0) }}
            </span>
        </div>
    @endif

    {{--RÉSULTAT SUR LES SALLES--}}
    @if($type == 'gyms')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ file_exists(storage_path('app/public/gyms/50/logo-' . $find->id . '.png')) ? '/storage/gyms/50/logo-' . $find->id . '.png' : '/img/icon-search-gym.svg' }}">
            <a href="{{ \App\Gym::webUrl($find->id, $find->label) }}">
                {{ $find->label }}
            </a><br>
            <span class="grey-text">
                {{ $find->big_city }}, {{ $find->region }} ({{ $find->code_country }})
            </span>
        </div>
    @endif

    {{--RÉSULTAT SUR LES ROUTES--}}
    @if($type == 'routes')

        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ ($find->crag->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-route.svg" : str_replace("1300", "50", $find->crag->bandeau) }}">
            <a class="button-open-route text-cursor" class="button-open-route" onclick="loadRoute({{ $find->id }})">
                <img src="/img/climb-{{ $find->climb_id }}.png" class="search-climb-type">
                @if(count($find->routeSections) > 1)
                    <span class="color-grade-54 text-normal">{{ count($find->routeSections) }} L.</span>
                @else
                    <span class="color-grade-{{ $find->routeSections[0]->grade_val }} text-normal">{{ $find->routeSections[0]->grade . $find->routeSections[0]->sub_grade }}</span>
                @endif
                {{ $find->label }}
            </a><br>
            <span class="grey-text">
                @lang('interface/search.inCrag')
                <a href="{{ $find->crag->url() }}">
                    {{ $find->crag->label }}
                </a>,
                {{ $find->crag->region }} ({{ $find->crag->code_country }})
            </span>
        </div>
    @endif

    {{--RÉSULTAT SUR LES ROUTES--}}
    @if($type == 'helps')

        <div class="col s12 blue-border-search rideau-animation">
            <strong>{{ $find->label }}</strong>
            <div class="markdownZone">
                @markdown($find->contents)
            </div>
        </div>
    @endif

    @if($type == 'topics')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="/img/forum-{{ $find->category_id }}.svg">
            <a target="_blank" href="{{ \App\ForumTopic::webUrl($find->id, $find->label) }}">
                {{ $find->label }}
            </a><br>
            <span class="grey-text">
                @lang('interface/search.suggestedBy')
                <a href="{{ $find->user->url() }}">
                    {{ $find->user->name }}
                </a>
            </span>
        </div>
    @endif

    {{--RÉSULTAT SUR UN TOPO PAPIER--}}
    @if($type == 'topos')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left couverture-topo" src="{{ (file_exists(storage_path('app/public/topos/50/topo-' . $find->id . '.jpg'))) ? '/storage/topos/50/topo-' . $find->id . '.jpg' : '/img/default-topo-couverture.svg' }}">
            <a href="{{ \App\Topo::webUrl($find->id, $find->label) }}">
                {{ $find->label }}
            </a><br>
            <span class="grey-text">
                {{ $find->author }}, {{ $find->editor }} ({{ $find->editionYear }})
            </span>
        </div>
    @endif

@endforeach

@if(count($finds) == 0)
    <p class="grey-text text-center">@lang('interface/search.noResultFor', ['search' => $search])</p>
@endif