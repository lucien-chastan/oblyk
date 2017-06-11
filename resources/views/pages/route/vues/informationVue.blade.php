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

            {{--INCLINAISON DE LA LIGNE--}}
            @if(count($route->routeSections) == 1)
                <p>
                    <span class="oblyk-icon icon-inclinaison_{{$route->routeSections[0]->incline->id}} grey-text"></span>
                    @if($route->routeSections[0]->incline->id != '1')
                        {{$route->routeSections[0]->incline->label}}
                    @else
                        <span class="grey-text text-italic">inclinaison non-renseignée</span>
                    @endif
                </p>
            @endif

            {{--NOMBRE DE LONGUEUR--}}
            @if(count($route->routeSections) > 1)
                <p><span class="oblyk-icon icon-nb_longueur grey-text"></span> {{count($route->routeSections)}} Longueurs</p>
            @endif

            {{--TYPE DE RECEPTION--}}
            @if($route->climb_id == 2)
                <p>
                    <span class="oblyk-icon icon-reception grey-text"></span>
                    @if($route->routeSections[0]['reception_id'] != 1)
                        {{$route->routeSections[0]->reception->label}}
                    @else
                        <span class="grey-text text-italic">réception non-renseignée</span>
                    @endif
                </p>
            @endif

            {{--TYPE DE RELAIS--}}
            @if($route->climb_id != 2 && $route->climb_id != 7 && count($route->routeSections) == 1)
                @if($route->routeSections[0]['anchor_id'] != '1')
                    <p><span class="oblyk-icon icon-relais_{{$route->routeSections[0]['anchor_id']}} grey-text"></span> {{$route->routeSections[0]->anchor->label}}</p>
                @else
                    <p><span class="oblyk-icon icon-relais_{{$route->routeSections[0]['anchor_id']}} grey-text"></span> <span class="grey-text text-italic">relais non-renseigné</span></p>
                @endif
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

            {{--TYPE D'ESCALADE--}}
            <p>
                <span class="oblyk-icon icon-climb_{{$route->climb->id}} grey-text"></span>
                <strong class="climb-color-{{$route->climb->id}}">{{$route->climb->label}}</strong>
            </p>

            {{--HAUTEUR DE LA LIGNE--}}
            <p>
                <span class="oblyk-icon icon-route_height grey-text"></span>
                @if($route->height != 0)
                    {{$route->height}} mètres
                @else
                    <span class="grey-text text-italic">hauteur non-renseignée</span>
                @endif
            </p>

            {{--TYPE DE POINT--}}
            @if($route->climb_id != 2 && $route->climb_id != 7 && count($route->routeSections) == 1)
                @if($route->routeSections[0]['point_id'] != '1')
                    <p><span class="oblyk-icon icon-point_{{$route->routeSections[0]['point_id']}} grey-text"></span> {{$route->routeSections[0]->point->label}}</p>
                @else
                    <p><span class="oblyk-icon icon-point_{{$route->routeSections[0]['point_id']}} grey-text"></span> <span class="grey-text text-italic">point non-renseigné</span></p>
                @endif
            @endif

            {{--TYPE DE DÉPART--}}
            @if($route->climb_id == 2)
                <p>
                    <span class="oblyk-icon icon-depart_{{$route->routeSections[0]['start_id']}} grey-text"></span>
                    @if($route->routeSections[0]['start_id'] != 1)
                        {{$route->routeSections[0]->start->label}}
                    @else
                        <span class="grey-text text-italic">départ non-renseignée</span>
                    @endif
                </p>
            @endif

        </div>
    </div>

    <div class="row">
        <div class="col s12 m6">

            {{--OUVREUR--}}
            @if($route->climb_id == 2 || $route->climb_id == 7)
                <p>
                    <span class="oblyk-icon icon-brosseur grey-text"></span>
                    @if($route->opener != '')
                        {{$route->opener}}
                    @else
                        <span class="grey-text text-italic">brosseur non-renseigné</span>
                    @endif
                </p>
            @else
                <p>
                    <span class="oblyk-icon icon-opener grey-text"></span>
                    @if($route->opener != '')
                        {{$route->opener}}
                    @else
                        <span class="grey-text text-italic">ouvreur non-renseigné</span>
                    @endif
                </p>
            @endif
        </div>
        <div class="col s12 m6">
            {{--ANNÉE D'OUVERTURE--}}
            <p>
                <span class="oblyk-icon icon-open_year grey-text"></span>
                @if($route->open_year != 0)
                    {{$route->open_year}}
                @else
                    année non-renseignée
                @endif
            </p>
        </div>

    </div>


    {{--LISTE DES LONGUEURS--}}
    @if(count($route->routeSections) > 1)

        <h5 class="loved-king-font">Liste des longueurs</h5>

        <div class="row">
            <div class="col s12">
                <table class="striped">
                    <thead>
                    <tr>
                        <th>L.</th>
                        <th>Côte</th>
                        <th>Relais</th>
                        <th>Point</th>
                        <th>Hauteur</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($route->routeSections as $section)
                        <tr>
                            <td>L. {{$section->section_order}}</td>
                            <td><strong class="color-grade-{{$section->grade_val}}">{{$section->grade}}{{$section->sub_grade}}</strong></td>
                            <td><span class="oblyk-icon icon-relais_{{$section->anchor->id}} grey-text"></span> {{$section->anchor->label}}</td>
                            <td><span class="oblyk-icon icon-point_{{$section->point->id}} grey-text"></span> {{$section->point->label}}</td>
                            <td>{{$section->section_height}} mètres</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif



    {{--PARTIE DESCRIPTION--}}
    <div class="row">

        <h5 class="loved-king-font">Description des grimpeurs</h5>

        <div class="col s12">
            description
        </div>

    </div>

</div>
