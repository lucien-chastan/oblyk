<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">timeline</i>@choice('home.new-route', count($activity['routes']))</div>
    <div class="collapsible-body">
        <div class="row">
            <div>
                @foreach($activity['routes'] as $route)
                    <div class="col s12 m6 l4 blue-border-activity-part truncate">
                        <a class="button-open-route text-cursor" class="button-open-route" onclick="loadRoute({{ $route->id }})">
                            <img src="/img/climb-{{ $route->climb_id }}.png" class="search-climb-type">
                            @if(count($route->routeSections) > 1)
                                <span class="color-grade-54 text-normal">{{ count($route->routeSections) }} L.</span>
                            @else
                                <span class="color-grade-{{ $route->routeSections[0]->grade_val }} text-normal">{{ $route->routeSections[0]->grade . $route->routeSections[0]->sub_grade }}</span>
                            @endif
                            {{ $route->label }}
                        </a>,
                        <a href="{{ route('cragPage',['crag_id'=>$route->crag->id, 'crag_label'=>str_slug($route->crag->label)]) }}">
                            {{ $route->crag->label }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</li>