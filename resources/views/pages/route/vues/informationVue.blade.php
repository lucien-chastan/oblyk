@inject('Helpers','App\Lib\HelpersTemplates')

<div class="information-route">

    <input type="hidden" id="info-route-id" value="{{$route->id}}">

    {{--PREMIÈRE PARTIE DES INFOS--}}

    <div class="row table-des-informations">
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



    {{--SECONDE PARTIE AVEC LES OUVREURS ET L'ANNÉE D'OUVERTURE--}}

    <div class="row table-des-informations">
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
                    <span class="grey-text text-italic">année non-renseignée</span>
                @endif
            </p>
        </div>

    </div>


    {{--BOUTON POUR LA MODIFICATION--}}
    <div class="ligne-bt-route">
        <p class="text-right">
            <i {!! $Helpers::tooltip('Modifier cette ligne') !!}} {!! $Helpers::modal(route('routeModal'),['id' => $route->id ,'title'=>'Modifier cette ligne','method'=>'PUT']) !!} class="material-icons tooltipped btnModal">edit</i>
            <i {!! $Helpers::tooltip('Signaler un problème') !!}} {!! $Helpers::modal(route('problemModal'), ["id" => $route->id , "model"=> "Route"]) !!} class="tooltipped material-icons btnModal">flag</i>
        </p>
    </div>


    {{--LISTE DES LONGUEURS--}}

    @if(count($route->routeSections) > 1)

        <h5 class="loved-king-font">Les longueurs</h5>

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

    <div class="row route-description-zone">

        <h5 class="loved-king-font">Description des grimpeurs</h5>

        <div class="col s12">
            <div class="blue-border-zone">
                @foreach ($route->descriptions as $description)
                    <div class="blue-border-div">
                        <div class="markdownZone">{{ $description->description }}</div>
                        <p class="info-user grey-text">
                            @if($description->note != 0)
                                <img class="note-description" src="/img/note_{{$description->note}}.png" alt="">
                            @endif
                            par {{$description->user->name}} le {{$description->created_at->format('d M Y')}}

                            @if(Auth::check())
                                <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                @if($description->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip('Modifier cette déscription') !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$route->id, "descriptive_type"=>"Route", "description_id"=>$description->id, "title"=>"Modifier la description", "method" => "PUT", "callback"=>"reloadRouteInformationTab"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                    <i {!! $Helpers::tooltip('Supprimer cette déscription') !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id, "callback"=>"reloadRouteInformationTab"]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                @endif
                            @endif
                        </p>
                    </div>
                @endforeach

                @if(count($route->descriptions) == 0)
                    <p class="grey-text text-center">Il n'y a aucune description postée par des grimpeurs, si tu as grimpé cette ligne pas à la décrire</p>
                @endif

            </div>
        </div>

        {{--BOUTON POUR AJOUTER UNE DESCRIPTION--}}
        @if(Auth::check())
            <div class="text-right btn-route-add">
                <a {!! $Helpers::tooltip('Rédiger un déscription') !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$route->id, "descriptive_type"=>'Route', "description_id"=>"", "title"=>"Ajouter une description", "method"=>"POST", "callback"=>"reloadRouteInformationTab"]) !!} class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">mode_edit</i></a>
            </div>
        @endif

    </div>
</div>

