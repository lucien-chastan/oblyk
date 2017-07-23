 <div class="liste-tick-ticklist">
    @foreach($crosses as $cross)
        <p class="no-margin">
            <span class="text-cursor button-open-route" onclick="loadRoute({{$cross->route->id}})">
                <img src="/img/climb-{{$cross->route->climb_id}}.png" height="10">
                <strong>
                    @if(count($cross->route->routeSections) == 1)
                        <span class="color-grade-{{$cross->route->routeSections[0]->grade_val}}">{{$cross->route->routeSections[0]->grade}}{{$cross->route->routeSections[0]->sub_grade}}</span>
                    @else
                        {{count($cross->route->routeSections)}}L.
                    @endif
                </strong>
                {{$cross->route->label}}, <span class="grey-text">{{$cross->crossStatus->label}}, le {{$cross->release_at->format('d M Y')}}</span>
            </span>
        </p>
    @endforeach
</div>