@foreach($finds as $find)

    {{--RÉSULTAT SUR UN MASSIF--}}
    @if($find->searchable_type == 'App\Massive')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="/img/icon-search-massive.svg">
            <a href="{{ route('massivePage',['massive_id' => $find->searchable->id, 'massive_label'=>str_slug($find->searchable->label)]) }}">
                {{ $find->searchable->label }}
            </a><br>
            <span class="grey-text">
                {{ trans_choice('interface/search.groupInfo', count($find->searchable->crags)) }}
            </span>
        </div>
    @endif

    {{--RÉSULTAT SUR UNE FALAISE--}}
    @if($find->searchable_type == 'App\Crag')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ ($find->searchable->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $find->searchable->bandeau) }}">
            <a href="{{ route('cragPage',['crag_id' => $find->searchable->id, 'crag_label'=>str_slug($find->searchable->label)]) }}">
                <img src="/img/point-{{ $find->searchable->type_voie . $find->searchable->type_grande_voie . $find->searchable->type_bloc . $find->searchable->type_deep_water . $find->searchable->type_via_ferrata }}.svg" class="search-climb-type">
                {{ $find->searchable->label }}
            </a><br>
            <span class="grey-text">
                {{ $find->searchable->region }} ({{ $find->searchable->code_country }})
            </span>
        </div>
    @endif


    {{--RÉSULTAT SUR UNE SALLE DE GRIMPE--}}
    @if($find->searchable_type == 'App\Gym')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ file_exists(storage_path('app/public/gyms/50/logo-' . $find->searchable->id . '.png')) ? '/storage/gyms/50/logo-' . $find->searchable->id . '.png' : '/img/icon-search-gym.svg' }}">
            <a href="{{ route('gymPage',['gym_id' => $find->searchable->id, 'gym_label'=>str_slug($find->searchable->label)]) }}">
                {{ $find->searchable->label }}
            </a><br>
            <span class="grey-text">
                {{ $find->searchable->big_city }}, {{ $find->searchable->region }} ({{ $find->searchable->code_country }})
            </span>
        </div>
    @endif

    {{--RÉSULTAT SUR UN USER--}}
    @if($find->searchable_type == 'App\User')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ file_exists(storage_path('app/public/users/100/user-' . $find->searchable->id . '.jpg')) ? '/storage/users/100/user-' . $find->searchable->id . '.jpg' : '/img/icon-search-user.svg' }}">
            <a href="{{ route('userPage',['user_id' => $find->searchable->id, 'user_label'=>str_slug($find->searchable->name)]) }}">
                {{ $find->searchable->name }}
            </a><br>
            <span class="grey-text">
                @lang('elements/sex.sex_' . $find->searchable->sex),
                {{ $find->searchable->birth != 0 ? trans_choice('elements/old.old', date('Y') - $find->searchable->birth) : trans_choice('elements/old.old',0) }}
            </span>
        </div>
    @endif

    {{--RÉSULTAT SUR UNE LIGNE--}}
    @if($find->searchable_type == 'App\Route')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ ($find->searchable->crag->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-route.svg" : str_replace("1300", "50", $find->searchable->crag->bandeau) }}">
            <a class="button-open-route text-cursor" class="button-open-route" onclick="loadRoute({{ $find->searchable->id }})">
                <img src="/img/climb-{{ $find->searchable->climb_id }}.png" class="search-climb-type">
                @if(count($find->searchable->routeSections) > 1)
                    <span class="color-grade-54 text-normal">{{ count($find->searchable->routeSections) }} L.</span>
                @else
                    <span class="color-grade-{{ $find->searchable->routeSections[0]->grade_val }} text-normal">{{ $find->searchable->routeSections[0]->grade . $find->searchable->routeSections[0]->sub_grade }}</span>
                @endif
                {{ $find->searchable->label }}
            </a><br>
            <span class="grey-text">
                @lang('interface/search.inCrag')
                <a href="{{ route('cragPage',['crag_id'=>$find->searchable->crag->id, 'crag_label'=>str_slug($find->searchable->crag->label)]) }}">
                    {{ $find->searchable->crag->label }}
                </a>,
                {{ $find->searchable->crag->region }} ({{ $find->searchable->crag->code_country }})
            </span>
        </div>
    @endif


    {{--RÉSULTAT SUR UN TOPO PAPIER--}}
    @if($find->searchable_type == 'App\Topo')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left couverture-topo" src="{{ (file_exists(storage_path('app/public/topos/50/topo-' . $find->searchable->id . '.jpg'))) ? '/storage/topos/50/topo-' . $find->searchable->id . '.jpg' : '/img/default-topo-couverture.svg' }}">
            <a href="{{ route('topoPage',['topo_id' => $find->searchable->id, 'topo_label'=>str_slug($find->searchable->label)]) }}">
                {{ $find->searchable->label }}
            </a><br>
            <span class="grey-text">
                {{ $find->searchable->author }}, {{ $find->searchable->editor }} ({{ $find->searchable->editionYear }})
            </span>
        </div>
    @endif


    {{--RÉSULTAT SUR UN TOPO PDF--}}
    @if($find->searchable_type == 'App\TopoPdf')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left couverture-topo" src="/img/default-topo-pdf-couverture.svg">
            <a href="/storage/topos/PDF/{{  $find->searchable->slug_label }}">
                {{ $find->searchable->label }}
            </a><br>
            <span class="grey-text">
                @lang('interface/search.inCrag')
                <a href="{{ route('cragPage', ['crag_id'=>$find->searchable->crag->id, 'crag_label'=>str_slug($find->searchable->crag->label)]) }}">
                    {{ $find->searchable->crag->label }}
                </a>
            </span>
        </div>
    @endif


    {{--RÉSULTAT SUR UN TOPO WEB--}}
    @if($find->searchable_type == 'App\TopoWeb')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left couverture-topo" src="/img/default-topo-web-couverture.svg">
            <a target="_blank" href="{{  $find->searchable->url }}">
                {{ $find->searchable->label }}
            </a><br>
            <span class="grey-text">
                @lang('interface/search.inCrag')
                <a href="{{ route('cragPage', ['crag_id'=>$find->searchable->crag->id, 'crag_label'=>str_slug($find->searchable->crag->label)]) }}">
                    {{ $find->searchable->crag->label }}
                </a>
            </span>
        </div>
    @endif


    {{--RÉSULTAT SUR UN SUJET DE FORUM--}}
    @if($find->searchable_type == 'App\ForumTopic')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="/img/forum-{{ $find->searchable->category_id }}.svg">
            <a target="_blank" href="{{  route('topicPage',['topic_id'=>$find->searchable->id,'topic_label'=>str_slug($find->searchable->label)]) }}">
                {{ $find->searchable->label }}
            </a><br>
            <span class="grey-text">
                @lang('interface/search.suggestedBy')
                <a href="{{ route('userPage', ['user_id'=>$find->searchable->user->id, 'user_label'=>str_slug($find->searchable->user->name)]) }}">
                    {{ $find->searchable->user->name }}
                </a>
            </span>
        </div>
    @endif


    {{--RÉSULTAT SUR LE LEXIQUE--}}
    @if($find->searchable_type == 'App\Word')
        <div class="col s12 blue-border-search rideau-animation">
            <a class="text-bold">{{ $find->searchable->label }}</a>
            <div class="markdownZone">
                @markdown($find->searchable->definition)
            </div>
        </div>
    @endif


    {{--RÉSULTAT SUR LE L'AIDE--}}
    @if($find->searchable_type == 'App\Help')
        <div class="col s12 blue-border-search rideau-animation">
            <strong>{{ $find->searchable->label }}</strong>
            <div class="markdownZone">
                @markdown($find->searchable->contents)
            </div>
        </div>
    @endif

@endforeach

@if(count($finds) == 0)
    <p class="grey-text text-center">
        @lang('interface/search.noResultFor', ['search' => $search])
    </p>
@endif