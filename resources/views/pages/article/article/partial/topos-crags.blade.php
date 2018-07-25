@if($nbTopo > 0 || $nbCrag > 0)
    <div class="enriched-article-area">
        @if($nbCrag > 0)
            <div class="col s12 {{ ($nbTopo > 0) ? 'm6 l8' : '' }}">
                <div id="article-map"></div>
            </div>
        @endif
        @if($nbTopo > 0)
            <div class="col s12 {{ ($nbCrag > 0) ? 'm6 l4' : '' }} text-center">
                <div class="text-center">
                    @foreach($article->articleTopos as $articleTopo)
                        <a class="grey-text" href="{{ route('topoPage', ['topo_id' => $articleTopo->topo->id, 'topo_label' => str_slug($articleTopo->topo->label)]) }}">
                            <img class="z-depth-3 guide-book-cover" src="{{ $articleTopo->topo->cover() }}">
                            <p class="loved-king-font no-margin truncate article-topo-link">
                                {{ $articleTopo->topo->label }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endif