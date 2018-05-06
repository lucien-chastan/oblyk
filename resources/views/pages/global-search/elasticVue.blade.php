@foreach($finds as $find)

    {{-- DEFINTIONS --}}
    @if($find->searchable_type == 'App\Word' && ($type == 'words' || $type == 'all'))
        <div class="col s12 blue-border-search rideau-animation">
            <a class="text-bold">{{ $find->label }}</a>
            <div class="markdownZone">
                @markdown($find->definition)
            </div>
        </div>
    @endif

    {{-- CRAGS --}}
    @if($find->searchable_type == 'App\Crag' && ($type == 'crags' || $type == 'all'))
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ ($find->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $find->bandeau) }}">
            <a href="{{ route('cragPage',['crag_id' => $find->id, 'crag_label'=>str_slug($find->label)]) }}">
                <img src="/img/point-{{ $find->type_voie . $find->type_grande_voie . $find->type_bloc . $find->type_deep_water . $find->type_via_ferrata }}.svg" class="search-climb-type">
                {{ $find->label }}
            </a><br>
            <span class="grey-text">
                {{ $find->region }} ({{ $find->code_country }})
            </span>
        </div>
    @endif

    {{-- CLIMBERS --}}
    @if($find->searchable_type == 'App\User' && ($type == 'users' || $type == 'all'))
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ file_exists(storage_path('app/public/users/100/user-' . $find->id . '.jpg')) ? '/storage/users/100/user-' . $find->id . '.jpg' : '/img/icon-search-user.svg' }}">
            <a href="{{ route('userPage',['user_id' => $find->id, 'user_label'=>str_slug($find->name)]) }}">
                {{ $find->name }}
            </a><br>
            <span class="grey-text">
                @lang('elements/sex.sex_' . ($find->sex ?? 0)),
                {{ $find->birth != 0 ? trans_choice('elements/old.old', date('Y') - $find->birth) : trans_choice('elements/old.old',0) }}
            </span>
        </div>
    @endif

    {{-- CLIMBING GYMS --}}
    @if($find->searchable_type == 'App\Gym' && ($type == 'gyms' || $type == 'all'))
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ file_exists(storage_path('app/public/gyms/50/logo-' . $find->id . '.png')) ? '/storage/gyms/50/logo-' . $find->id . '.png' : '/img/icon-search-gym.svg' }}">
            <a href="{{ route('gymPage',['gym_id' => $find->id, 'gym_label'=>str_slug($find->label)]) }}">
                {{ $find->label }}
            </a><br>
            <span class="grey-text">
                {{ $find->big_city }}, {{ $find->region }} ({{ $find->code_country }})
            </span>
        </div>
    @endif

    {{-- ROUTES --}}
    @if($find->searchable_type == 'App\Route' && ($type == 'routes' || $type == 'all'))
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
                <a href="{{ route('cragPage',['crag_id'=>$find->crag->id, 'crag_label'=>str_slug($find->crag->label)]) }}">
                    {{ $find->crag->label }}
                </a>,
                {{ $find->crag->region }} ({{ $find->crag->code_country }})
            </span>
        </div>
    @endif

    {{-- HELPS--}}
    @if($find->searchable_type == 'App\Help' && ($type == 'helps' || $type == 'all'))
        <div class="col s12 blue-border-search rideau-animation">
            <strong>{{ $find->label }}</strong>
            <div class="markdownZone">
                @markdown($find->contents)
            </div>
        </div>
    @endif

    {{-- FORUM --}}
    @if($find->searchable_type == 'App\Topic' && ($type == 'topics' || $type == 'all'))
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="/img/forum-{{ $find->category_id }}.svg">
            <a target="_blank" href="{{  route('topicPage',['topic_id'=>$find->id,'topic_label'=>str_slug($find->label)]) }}">
                {{ $find->label }}
            </a><br>
            <span class="grey-text">
                @lang('interface/search.suggestedBy')
                <a href="{{ route('userPage', ['user_id'=>$find->user->id, 'user_label'=>str_slug($find->user->name)]) }}">
                    {{ $find->user->name }}
                </a>
            </span>
        </div>
    @endif

    {{-- GUIDEBOOKS--}}
    @if($find->searchable_type == 'App\Topo' && ($type == 'topos' || $type == 'all'))
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left couverture-topo" src="{{ (file_exists(storage_path('app/public/topos/50/topo-' . $find->id . '.jpg'))) ? '/storage/topos/50/topo-' . $find->id . '.jpg' : '/img/default-topo-couverture.svg' }}">
            <a href="{{ route('topoPage',['topo_id' => $find->id, 'topo_label'=>str_slug($find->label)]) }}">
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