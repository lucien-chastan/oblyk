@foreach($friendsCrosses as $cross)
    <p class="no-margin">
        <a class="text-hover" href="{{ $cross->user->url() }}">{{ $cross->user->name }}</a> <span class="grey-text">a réalisé(e) :</span>
        <span class="button-open-route text-cursor text-hover" onclick="loadRoute({{ $cross->route->id }})">
            <img src="/img/climb-{{ $cross->route->climb_id }}.png" height="10">
            <strong>
                @if(count($cross->route->routeSections) > 1)
                    {{ count($cross->route->routeSections) }} L.
                @else
                    <span class="color-grade-{{ $cross->route->routeSections[0]->grade_val }}">{{ $cross->route->routeSections[0]->grade . $cross->route->routeSections[0]->sub_grade }}</span>
                @endif
            </strong>
            {{ $cross->route->label }}
        </span>
        <span class="grey-text">{{ ucfirst($cross->crossStatus->label) }} le {{ $cross->release_at->format('d M Y') }}</span>
    </p>
@endforeach