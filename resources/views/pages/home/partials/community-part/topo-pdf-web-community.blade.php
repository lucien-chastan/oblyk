<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">picture_as_pdf</i>@choice('home.new-topo-web-pdf', count($activity['toposWeb']) + count($activity['toposPdf']))</div>
    <div class="collapsible-body">
        <div class="row">
            <div>
                @foreach($activity['toposPdf'] as $topoPdf)
                    <div class="col s12 m6 l4 blue-border-activity-part">
                        <span class="text-bold">PDF : </span>
                        <a href="/storage/topos/PDF/{{  $topoPdf->slug_label }}">
                            {{ $topoPdf->label }}
                        </a><br>
                        <span class="grey-text">
                            @lang('interface/search.inCrag')
                            <a href="{{ route('cragPage', ['crag_id'=>$topoPdf->crag->id, 'crag_label'=>str_slug($topoPdf->crag->label)]) }}">
                                {{ $topoPdf->crag->label }}
                            </a>
                        </span>
                    </div>
                @endforeach

                @foreach($activity['toposWeb'] as $topoWeb)
                    <div class="col s12 m6 l4 blue-border-activity-part">
                        <span class="text-bold">WEB : </span>
                        <a target="_blank" href="{{  $topoWeb->url }}">
                            {{ $topoWeb->label }}
                        </a><br>
                        <span class="grey-text">
                            @lang('interface/search.inCrag')
                            <a href="{{ route('cragPage', ['crag_id'=>$topoWeb->crag->id, 'crag_label'=>str_slug($topoWeb->crag->label)]) }}">
                                {{ $topoWeb->crag->label }}
                            </a>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</li>