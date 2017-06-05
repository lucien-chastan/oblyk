<div class="information-route">

    <div class="row">
        <div class="col s12 m6">

            {{--NOM DE LA LIGNE + COTATION + TYPE--}}
            <p>
                <span class="oblyk-icon icon-nom grey-text"></span>
                <img src="/img/climb-{{$route->climb_id}}.png" alt="" class="type-ligne-route">
                @if(count($route->routeSections) > 1)
                    {{count($route->routeSections)}}.L
                @else
                    <strong class="color-grade-{{$route->routeSections[0]->grade_val}}">{{$route->routeSections[0]->grade}}{{$route->routeSections[0]->sub_grade}}</strong>
                @endif
                {{$route->label}}
            </p>

            {{--NOM DU SITE--}}
            <p>
                <span class="oblyk-icon icon-crag grey-text"></span>
                <a class="blue-text" href="/site-escalade/{{$route->crag->id}}/{{str_slug($route->crag->label)}}">{{$route->crag->label}}</a>
            </p>

            {{--DIFFICULTÉ DE LA COTATION--}}
            <p><span class="oblyk-icon icon-stronger grey-text"></span> Dur pour la cotation</p>

            {{--TYPE DE RECEPTION--}}
            @if($route->climb_id == 2)
                <p><span class="oblyk-icon icon-reception grey-text"></span> Réception correct</p>
            @endif

            {{--TYPE DE RELAIS--}}
            @if($route->climb_id != 2 && $route->climb_id != 7 && count($route->routeSections) == 1)
                <p><span class="oblyk-icon icon-type_anchor grey-text"></span> relais chaîné</p>
            @endif

        </div>
        <div class="col s12 m6">

            {{--NOTE--}}
            <p><span class="oblyk-icon icon-note grey-text"></span> <img src="/img/note_{{$route->note}}.png" alt="" class="img-note-route-sector"> {{$route->nb_note}} votes</p>

            {{--NOM DU SECTEUR--}}
            <p>
                <span class="oblyk-icon icon-sector grey-text"></span>
                <a class="blue-text" href="/site-escalade/{{$route->crag->id}}/{{str_slug($route->crag->label)}}#voie">{{$route->sector->label}}</a>
            </p>

            {{--HAUTEUR DE LA LIGNE--}}
            <p><span class="oblyk-icon icon-route_height grey-text"></span> {{$route->height}} mètres</p>

            {{--TYPE D'ÉQUIPEMENT--}}
            @if($route->climb_id != 2 && $route->climb_id != 7)
                <p><span class="oblyk-icon icon-point grey-text"></span> Plaquette</p>
            @endif

            {{--NOMBRE DE LONGUEUR--}}
            @if(count($route->routeSections) > 1)
                <p><span class="oblyk-icon icon-nb_longueur grey-text"></span> 5 Longueurs</p>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col s12 m6">
            @if($route->climb_id == 2 || $route->climb_id == 7)
                <p><span class="oblyk-icon icon-brosseur grey-text"></span> {{$route->opener}}</p>
            @else
                <p><span class="oblyk-icon icon-opener grey-text"></span> {{$route->opener}}</p>
            @endif
        </div>
        <div class="col s12 m6">
            <p><span class="oblyk-icon icon-open_year grey-text"></span> {{$route->open_year}}</p>
        </div>

    </div>
</div>
