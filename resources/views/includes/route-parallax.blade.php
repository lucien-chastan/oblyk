<div class="parallax-container route-parallax">
    <div class="row entete-info container">
        <div class="square-entete">
            <img src="/img/route-{{ $route_type }}.svg" alt="">
        </div>
        <div class="liste-info">
            <h1 class="loved-king-font">
                {{$label}}
                @if(count($route->routeSections) > 1)
                    {{count($route->routeSections)}}.L
                @else
                    <strong>{{$route->routeSections[0]->grade}}{{$route->routeSections[0]->sub_grade}}</strong>
                @endif
            </h1>
            <p><i class="material-icons left">terrain</i><a class="white-text" href="{{ route('cragPage', ['crag_id'=>$crag->id, 'crag_label'=>str_slug($crag->label)]) }}">{{$crag->label}}</a></p>
            <p><a class="white-text" href="{{ route('map') }}#{{$crag->lat}}/{{$crag->lng}}/15">{{$crag->city}}, {{$crag->region}} ({{$crag->code_country}})</a></p>
        </div>
    </div>

    <div class="parallax">
        <img class="img-route-parallax" src="{{$imgSrc}}" alt="{{$imgAlt}}">
    </div>
</div>