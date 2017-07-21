@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">

    @if(isset($ticklist))
        <p class="text-center">{{$route->label}} fait partie de ma <a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#tick-list">tick list</a></p>
        <p class="text-center"><a {!! $Helpers::tooltip('Supprimer de ma tick list') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/tickLists/" . $ticklist->id, "callback"=>"reloadRouteCarnetTab"]) !!} class="i-cursor tooltipped btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">delete</i></a></p>
    @else
        @if(Auth::check() && count($crosses) == 0)
            <div class="text-center band-bt-add-carnet">
                <a class="btn-flat waves-effect text-cursor btn-add-in-cross-book" onclick="addInTickList({{$route->id}})"><i class="material-icons">crop_free</i> Ajouter à la tickList</a>
            </div>
        @endif
    @endif

    @if(count($crosses) > 0)

        <div class="blue-border-zone crosses-zone">

            <h2 class="loved-king-font">Dans mon carnet</h2>

            @foreach($crosses as $cross)

                <div class="blue-border-div div-one-cross">
                    <div class="blue circle circle-date">
                        <p class="no-margin">
                            {{$cross->release_at->format('d M')}}<br>
                            {{$cross->release_at->format('Y')}}
                        </p>
                    </div>
                    <div class="info-cross">

                        <p class="grey-text title-date-cross">
                            Croix du {{$cross->release_at->format('d M Y')}}

                            <span class="grey-text">
                                <i {!! $Helpers::tooltip('Modifier ma croix') !!} class="material-icons tiny tooltipped">edit</i>
                                <i {!! $Helpers::tooltip('Supprimer ma croix') !!} class="material-icons tiny tooltipped">delete</i>
                            </span>
                        </p>

                        <strong>Status : </strong> {{ ucfirst($cross->crossStatus->label) }}<br>

                        @if($route->route_sections_count == 1)
                            {{--Si voie d'un longueur--}}
                            <strong>Mode : </strong> {{ ucfirst($cross->crossSections[0]->crossMode->label) }}<br>

                        @else
                            {{--Si voie de plusieur longueur--}}
                            @if($route->route_sections_count == count($cross->crossSections))
                                <strong>J'ai fais les {{ $route->route_sections_count }} longueurs</strong><br>
                            @else
                                <strong>Longueurs faites :</strong>
                                <ul>
                                    @foreach($cross->crossSections as $section)
                                        <li>L.{{$section->routeSection->section_order}} {{$section->routeSection->grade}}{{$section->routeSection->sub_grade}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        @endif

                        <strong>J'étais avec :</strong>
                        <span class="virgule">
                            @foreach($cross->crossUsers as $user)
                                <span><a href="{{ route('userPage', ['user_id'=>$user->user->id, 'user_label'=>str_slug($user->user->name)]) }}">{{ $user->user->name }}</a></span>
                            @endforeach
                        </span>
                    </div>
                </div>

            @endforeach
        </div>
    @endif

    @if(count($crosses) == 0)
        <div class="text-center band-bt-add-carnet">
            <a class="btn-flat waves-effect text-cursor btn-add-in-cross-book"><i class="material-icons">done</i> Ajouter à mon carnet de croix</a>
        </div>
    @else
        <div class="text-center band-bt-add-carnet">
            <a class="btn-flat waves-effect text-cursor btn-add-in-cross-book"><i class="material-icons">repeat</i> Ajouter une répétition</a>
        </div>
    @endif



</div>
