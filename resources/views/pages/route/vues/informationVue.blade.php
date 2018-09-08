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
            <p>
                <span class="oblyk-icon icon-stronger grey-text"></span>
                @if($hardness['trend'] != 0)
                    <span data-html="true" {!! $Helpers::tooltip(trans('pages/routes/tabs/information.hardnessTool', ['easy'=>$hardness['easy'], 'just'=>$hardness['just'], 'hard'=>$hardness['hard']])) !!} class="tooltipped">
                        @lang('elements/hardnesses.hardness_' . $hardness['trend'])
                        <span class="grey-text">
                            ( @choice('pages/routes/tabs/information.nbVote', $hardness['nbVote']) )
                        </span>
                    </span>
                @else
                    <cite class="grey-text">@lang('pages/routes/tabs/information.noEvaluation')</cite>
                @endif
            </p>

            {{--INCLINAISON DE LA LIGNE--}}
            @if(count($route->routeSections) == 1)
                <p>
                    <span class="oblyk-icon icon-inclinaison_{{$route->routeSections[0]->incline->id}} grey-text"></span>
                    @if($route->routeSections[0]->incline->id != '1')
                        @lang('elements/inclines.incline_' . $route->routeSections[0]->incline->id)
                    @else
                        <span class="grey-text text-italic">@lang('pages/routes/tabs/information.noIncline')</span>
                    @endif
                </p>
            @endif

            {{--NOMBRE DE LONGUEUR--}}
            @if(count($route->routeSections) > 1)
                <p><span class="oblyk-icon icon-nb_longueur grey-text"></span>@choice('pages/routes/tabs/information.nbLongueur', count($route->routeSections))</p>
            @endif

            {{--TYPE DE RECEPTION--}}
            @if($route->climb_id == 2)
                <p>
                    <span class="oblyk-icon icon-reception grey-text"></span>
                    @if($route->routeSections[0]['reception_id'] != 1)
                        @lang('elements/receptions.reception_' . $route->routeSections[0]->reception->id)
                    @else
                        <span class="grey-text text-italic">@lang('pages/routes/tabs/information.noReception')</span>
                    @endif
                </p>
            @endif

            {{--TYPE DE RELAIS--}}
            @if($route->climb_id != 2 && $route->climb_id != 7 && count($route->routeSections) == 1)
                @if($route->routeSections[0]['anchor_id'] != '1')
                    <p><span class="oblyk-icon icon-relais_{{$route->routeSections[0]['anchor_id']}} grey-text"></span> @lang('elements/anchors.anchor_' . $route->routeSections[0]->anchor->id)</p>
                @else
                    <p><span class="oblyk-icon icon-relais_{{$route->routeSections[0]['anchor_id']}} grey-text"></span> <span class="grey-text text-italic">@lang('pages/routes/tabs/information.noAnchor')</span></p>
                @endif
            @endif

        </div>



        <div class="col s12 m6">

            {{--NOTE--}}
            <p><span class="oblyk-icon icon-note grey-text"></span> <img src="/img/note_{{$route->note}}.png" alt="" class="img-note-route-sector"> @choice('pages/routes/tabs/information.nbVote', $route->nb_note)</p>

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
                    @choice('pages/routes/tabs/information.height', $route->height)
                @else
                    <span class="grey-text text-italic">@lang('pages/routes/tabs/information.noHeight')</span>
                @endif
            </p>

            {{--TYPE DE POINT--}}
            @if($route->climb_id != 2 && $route->climb_id != 7 && count($route->routeSections) == 1)
                @if($route->routeSections[0]['point_id'] != '1')
                    <p><span class="oblyk-icon icon-point_{{$route->routeSections[0]['point_id']}} grey-text"></span> @lang('elements/points.point_' . $route->routeSections[0]->point->id)</p>
                @else
                    <p><span class="oblyk-icon icon-point_{{$route->routeSections[0]['point_id']}} grey-text"></span> <span class="grey-text text-italic">@lang('pages/routes/tabs/information.noPoint')</span></p>
                @endif
            @endif

            {{--TYPE DE DÉPART--}}
            @if($route->climb_id == 2)
                <p>
                    <span class="oblyk-icon icon-depart_{{$route->routeSections[0]['start_id']}} grey-text"></span>
                    @if($route->routeSections[0]['start_id'] != 1)
                        @lang('elements/starts.start_' . $route->routeSections[0]->start->id)
                    @else
                        <span class="grey-text text-italic">@lang('pages/routes/tabs/information.noStart')</span>
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
                        <span class="grey-text text-italic">@lang('pages/routes/tabs/information.noBoulderOpener')</span>
                    @endif
                </p>
            @else
                <p>
                    <span class="oblyk-icon icon-opener grey-text"></span>
                    @if($route->opener != '')
                        {{$route->opener}}
                    @else
                        <span class="grey-text text-italic">@lang('pages/routes/tabs/information.noRouteOpener')</span>
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
                    <span class="grey-text text-italic">@lang('pages/routes/tabs/information.noOpenYear')</span>
                @endif
            </p>
        </div>

    </div>

    {{--LES TAGS--}}
    <div class="row table-des-informations">
        <div class="col s12">
            @foreach($route->tags as $tag)
                <cite>
                    #@lang('elements/tags.tag_' . $tag->tag_id)
                </cite>
            @endforeach
            <a {!! $Helpers::modal(route('tagModal'),['route_id' => $route->id ,'title'=>trans('modals/tag.modalAddTitle'), 'method'=>'POST', 'callback'=>'reloadRouteInformationTab']) !!} class="btnModal text-cursor" onclick="$('#modal').modal('open');">+ Ajouter des tags</a>
        </div>
    </div>

    {{--BOUTON POUR LA MODIFICATION--}}
    <div class="ligne-bt-route">
        @if(Auth::check())
            <p class="text-right">
                <i {!! $Helpers::tooltip(trans('modals/route.editTooltip')) !!}} {!! $Helpers::modal(route('routeModal'),['id' => $route->id ,'title'=>trans('modals/route.modalEditeTitle'),'method'=>'PUT']) !!} class="material-icons tooltipped btnModal" onclick="$('#modal').modal('open');">edit</i>
                <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!}} {!! $Helpers::modal(route('problemModal'), ["id" => $route->id , "model"=> "Route"]) !!} class="tooltipped material-icons btnModal" onclick="$('#modal').modal('open');">flag</i>
                @if($route->versions_count > 0)
                    <i {!! $Helpers::tooltip(trans('modals/version.tooltip')) !!} {!! $Helpers::modal(route('versionModal'), ["id"=>$route->id, "model"=>"Route"]) !!} class="material-icons tooltipped btnModal" onclick="$('#modal').modal('open');">history</i>
                @endif
            </p>
        @endif
    </div>


    {{--LISTE DES LONGUEURS--}}
    @if(count($route->routeSections) > 1)

        <h5 class="loved-king-font">@lang('pages/routes/tabs/information.pitchTitle')</h5>

        <div class="row">
            <div class="col s12">
                <table class="striped">
                    <thead>
                    <tr>
                        <th>L.</th>
                        <th>@lang('pages/routes/tabs/information.gradeColumn')</th>
                        <th>@lang('pages/routes/tabs/information.anchorColumn')</th>
                        <th>@lang('pages/routes/tabs/information.pointColumn')</th>
                        <th>@lang('pages/routes/tabs/information.heightColumn')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($route->routeSections as $section)
                        <tr>
                            <td>L. {{$section->section_order}}</td>
                            <td><strong class="color-grade-{{$section->grade_val}}">{{$section->grade}}{{$section->sub_grade}}</strong></td>
                            <td><span class="oblyk-icon icon-relais_{{$section->anchor->id}} grey-text"></span> @lang('elements/anchors.anchor_' . $section->anchor->id)</td>
                            <td><span class="oblyk-icon icon-point_{{$section->point->id}} grey-text"></span> @lang('elements/points.point_' . $section->point->id)</td>
                            <td>@choice('pages/routes/tabs/information.height', $section->section_height)</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif




    {{--PARTIE DESCRIPTION--}}

    <div class="row route-description-zone">

        <h5 class="loved-king-font">@lang('pages/routes/tabs/information.descriptionTitle')</h5>

        <div class="col s12">
            <div class="blue-border-zone">
                @foreach ($route->descriptions as $description)
                    <div class="blue-border-div">
                        @if($description->private == 1)
                            @if(Auth::check() && $description->user_id == Auth::user()->id)
                                <i {!! $Helpers::tooltip(trans('modals/cross.private_comment')) !!} class="material-icons left grey-text text-lighten-1 tooltipped">vpn_key</i>
                                <div class="markdownZone">{{ $description->description }}</div>
                            @else
                                <div class="markdownZone"><cite class="grey-text">commentaire privé</cite></div>
                            @endif
                        @else
                            <div class="markdownZone">{{ $description->description }}</div>
                        @endif
                        <p class="info-user grey-text">
                            @if($description->note != 0)
                                <img class="note-description" src="/img/note_{{$description->note}}.png" alt="">
                            @endif
                                @lang('modals/description.postByDate', ['name'=>$description->user->name, 'url'=>$description->user->url(), 'date'=>$description->created_at->format('d M Y')])

                            @if(Auth::check())
                                <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal" onclick="$('#modal').modal('open');">flag</i>
                                @if($description->user_id == Auth::id())
                                    <i {!! $Helpers::tooltip(trans('modals/description.editTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$route->id, "descriptive_type"=>"Route", "description_id"=>$description->id, "title"=>trans('modals/description.modalEditeTitle'), "method" => "PUT", "callback"=>"reloadRouteInformationTab"]) !!} class="material-icons tiny-btn right tooltipped btnModal" onclick="$('#modal').modal('open');">edit</i>
                                    <i {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id, "callback"=>"reloadRouteInformationTab"]) !!} class="material-icons tiny-btn right tooltipped btnModal" onclick="$('#modal').modal('open');">delete</i>
                                @endif
                            @endif
                        </p>
                    </div>
                @endforeach

                @if(count($route->descriptions) == 0)
                    <p class="grey-text text-center">@lang('pages/routes/tabs/information.noDescription')</p>
                @endif

            </div>
        </div>

        {{--BOUTON POUR AJOUTER UNE DESCRIPTION--}}
        @if(Auth::check())
            <div class="text-right btn-route-add">
                <a {!! $Helpers::tooltip(trans('modals/description.addTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$route->id, "descriptive_type"=>'Route', "description_id"=>"", "title"=>trans('modals/description.modalAddTitle'), "method"=>"POST", "callback"=>"reloadRouteInformationTab"]) !!} class="btn-floating btn waves-effect waves-light tooltipped btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">mode_edit</i></a>
            </div>
        @endif

    </div>
</div>

