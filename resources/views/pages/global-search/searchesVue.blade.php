@foreach($finds as $find)

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


    {{--RÉSULTAT SUR UN USER--}}
    @if($find->searchable_type == 'App\User')
        <div class="col s12 blue-border-search crag-result rideau-animation">
            <img class="left circle" src="{{ file_exists(storage_path('app/public/users/100/user-' . $find->searchable->id . '.jpg')) ? '/storage/users/100/user-' . $find->searchable->id . '.jpg' : '/img/icon-search-user.svg' }}">
            <a href="{{ route('userPage',['user_id' => $find->searchable->id, 'user_label'=>str_slug($find->searchable->name)]) }}">
                {{ $find->searchable->name }}
            </a><br>
            <span class="grey-text">
                @if($find->searchable->sex == 0) Indéfini, @endif
                @if($find->searchable->sex == 1) Femme, @endif
                @if($find->searchable->sex == 2) Homme, @endif
                {{ $find->searchable->birth != 0 ? date('Y') - $find->searchable->birth : '?' }} ans
            </span>
        </div>
    @endif


    {{--RÉSULTAT SUR LE LEXIQUE--}}
    @if($find->searchable_type == 'App\Word')
        <div class="col s12 blue-border-search rideau-animation">
            <a class="text-bold">{{ $find->searchable->label }}</a><br>
            {{ $find->searchable->definition }}
        </div>
    @endif

@endforeach

@if(count($finds) == 0)
    <p class="grey-text text-center">
        Il n'y a pas de résultat pour la recherche : " {{ $search }} "
    </p>
@endif