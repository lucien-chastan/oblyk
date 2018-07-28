<div class="row">
    <div class="col s6 m4 l4">
        <p>
            <i class="material-icons left">public</i>
            {{ count($pays) }} Pays
        </p>
    </div>
    <div class="col s6 m4 l4">
        <p>
            <i class="material-icons left">terrain</i>
            {{ count($crags) }} Sites
        </p>
    </div>
    <div class="col s6 m4 l4">
        <p>
            <i class="material-icons left">nature</i>
            {{ count($regions) }} Regions
        </p>
    </div>
    <div class="col s6 m4 l4">
        <p>
            <i class="material-icons left">done_all</i>
            {{ count($crosses) }} Croix
        </p>
    </div>
    <div class="col s6 m4 l4">
        <p>
            <i class="material-icons left">functions</i>
            {{ $metres }} mètres
        </p>
    </div>
    <div class="col s6 m4 l4">
        <p>
            <i class="material-icons left">vertical_align_top</i>
            <span class="color-grade-{{$max_val}} text-bold">{{ $max_grade . $max_sub_grade }}</span> max
        </p>
    </div>
</div>

<div class="row">
    <p class="text-underline">Mes 5 derniers ticks : </p>
    @foreach($lastTicks as $tick)
        <p class="no-margin">
            <span class="button-open-route text-cursor text-hover" onclick="loadRoute({{ $tick->route->id }})">
                <img src="/img/climb-{{ $tick->route->climb_id }}.png" height="10">
                <strong>
                    @if(count($tick->route->routeSections) > 1)
                        {{ count($tick->route->routeSections) }} L.
                    @else
                        <span class="color-grade-{{ $tick->route->routeSections[0]->grade_val }}">{{ $tick->route->routeSections[0]->grade . $tick->route->routeSections[0]->sub_grade }}</span>
                    @endif
                </strong>
                {{ $tick->route->label }}
            </span>
            <span class="grey-text"><a class="grey-text text-hover" href="{{ $tick->route->crag->url() }}">{{ $tick->route->crag->label }}</a>, {{ $tick->route->crag->region }} ({{ $tick->route->crag->code_country }})</span>
        </p>
    @endforeach

    @if(count($lastTicks) == 0)
        <p class="grey-text text-center text-bold">Tu n'as pas de ligne dans ta ticklist</p>
    @endif
</div>

<div class="row">
    <p class="text-underline">Mes 5 dernières croix :</p>
    @foreach($lastCrosses as $cross)
        <p class="no-margin">
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
            <span class="grey-text"><a class="grey-text text-hover" href="{{ $cross->route->crag->url() }}">{{ $cross->route->crag->label }}</a>, {{ $cross->route->crag->region }} ({{ $cross->route->crag->code_country }})</span>
        </p>
    @endforeach

    @if(count($lastCrosses) == 0)
        <p class="grey-text text-center text-bold">Tu n'as pas de croix dans ta carnet</p>
    @endif
</div>

<p class="text-right no-margin bt-go-to-nav-item">
    <a onclick="loadProfileRoute(document.getElementById('item-ticklist-nav'))"><i class="material-icons tiny">crop_free</i> ma ticklist</a>
    <a onclick="loadProfileRoute(document.getElementById('item-mes-croix-nav'))"><i class="material-icons tiny">done_all</i> mon carnet</a>
</p>