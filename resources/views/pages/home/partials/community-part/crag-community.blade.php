<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">terrain</i>@choice('home.new-crag', count($activity['crags']))</div>
    <div class="collapsible-body">
        <div class="row">
            @foreach($activity['crags'] as $crag)
                <div class="col s12 m6 l4 blue-border-activity-part">
                    <img class="left circle"
                         src="{{ ($crag->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $crag->bandeau) }}">
                    <a href="{{ route('cragPage',['crag_id' => $crag->id, 'crag_label'=>str_slug($crag->label)]) }}">
                        <img src="/img/point-{{ $crag->type_voie . $crag->type_grande_voie . $crag->type_bloc . $crag->type_deep_water . $crag->type_via_ferrata }}.svg" class="search-climb-type">
                        {{ $crag->label }}
                    </a><br>
                    <span class="grey-text">
                        {{ $crag->region }} ({{ $crag->code_country }})
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</li>