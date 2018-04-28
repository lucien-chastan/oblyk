<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">local_library</i>@choice('home.new-topo', count($activity['topos']))</div>
    <div class="collapsible-body">
        <div class="row">
            <div>
                @foreach($activity['topos'] as $topo)
                    <div class="col s12 m6 l4 blue-border-activity-part">
                        <img class="left couverture-topo" src="{{ (file_exists(storage_path('app/public/topos/50/topo-' . $topo->id . '.jpg'))) ? '/storage/topos/50/topo-' . $topo->id . '.jpg' : '/img/default-topo-couverture.svg' }}">
                        <a href="{{ route('topoPage',['topo_id' => $topo->id, 'topo_label'=>str_slug($topo->label)]) }}">
                            {{ $topo->label }}
                        </a><br>
                        <span class="grey-text">
                            {{ $topo->author }}, {{ $topo->editor }} ({{ $topo->editionYear }})
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</li>