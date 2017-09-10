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
                                <i {!! $Helpers::modal(route('crossModal'), ["cross_id"=>$cross->id, "route_id"=>$route->id, 'title'=>'Modifier ma croix', 'method'=>'PUT', 'callback'=>'reloadRouteCarnetTab']) !!} {!! $Helpers::tooltip('Modifier ma croix') !!} onclick="$('#modal').modal('open');" class="material-icons tiny tooltipped btnModal">edit</i>
                                <i {!! $Helpers::modal(route('deleteModal'), ["route"=>"/crosses/" . $cross->id, "callback"=>"reloadRouteCarnetTab"]) !!} {!! $Helpers::tooltip('Supprimer ma croix') !!} onclick="$('#modal').modal('open');" class="material-icons tiny tooltipped btnModal">delete</i>
                            </span>
                        </p>

                        <strong>{{ $cross->crossStatus->label }}</strong>
                        @if($route->climb_id != 2 && $route->climb_id != 7 && $route->climb_id != 8)
                            , en <strong>{{ $cross->crossMode->label }}</strong>
                        @endif
                        @if($cross->crossHardness->id != 1)
                            , j'ai trouvé ça <strong>{{ $cross->crossHardness->label }}</strong>
                        @endif
                        <br>

                        @if($route->route_sections_count > 1)

                            {{--Si voie de plusieur longueur--}}
                            @if($route->route_sections_count == count($cross->crossSections))
                                <strong>J'ai fait les {{ $route->route_sections_count }} longueurs</strong><br>
                            @else
                                <strong>Longueurs faites {{ count($cross->crossSections) }}/{{ $route->route_sections_count }} :</strong>
                                <ul>
                                    @foreach($cross->crossSections as $section)
                                        <li>L.{{$section->routeSection->section_order}} <span class="text-bold color-grade-{{$section->routeSection->grade_val}}">{{$section->routeSection->grade}}{{$section->routeSection->sub_grade}}</span> ( {{$section->routeSection->section_height}} mètres )</li>
                                    @endforeach
                                </ul>
                            @endif

                        @endif
                        <strong>Nombre de tentative : </strong>{{ $cross->attempt }}<br>
                        <strong>J'étais avec :</strong>
                        <span class="virgule">
                            @foreach($cross->crossUsers as $user)
                                <span><a href="{{ route('userPage', ['user_id'=>$user->user->id, 'user_label'=>str_slug($user->user->name)]) }}">{{ $user->user->name }}</a></span>
                            @endforeach
                            <i {!! $Helpers::tooltip('Éditer la liste des potes qui étaient avec moi') !!} {!! $Helpers::modal(route('crossUserModal'), ["route"=>"/cross/users", "cross_id"=>$cross->id, "title"=>"Les potes qui étaient avec moi", "method"=>"POST", "callback"=>"reloadRouteCarnetTab"]) !!} onclick="$('#modal').modal('open');" class="material-icons grey-text bt-add-grimpeur-on-cross tooltipped btnModal">group_add</i>
                        </span>

                        @if(isset($cross->description->description))
                            <div class="markdownZone">{{ $cross->description->description }}</div>
                            @if($cross->description->note != 0)
                                <p class="no-margin">Note : <img src="/img/note_{{ $cross->description->note }}.png" height="15"></p>
                            @endif
                        @endif

                    </div>
                </div>

            @endforeach
        </div>
    @endif

    @if(count($crosses) == 0)
        <div class="text-center band-bt-add-carnet">
            <a {!! $Helpers::modal(route('crossModal'), ["cross_id"=>'', "route_id"=>$route->id, 'title'=>'Ajouter une croix à mon carnet', 'method'=>'POST', 'callback'=>'reloadRouteCarnetTab']) !!} class="btn-flat waves-effect text-cursor btn-add-in-cross-book btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">done</i> Ajouter à mon carnet de croix</a>
        </div>
    @else
        <div class="text-center band-bt-add-carnet">
            <a {!! $Helpers::modal(route('crossModal'), ["cross_id"=>'', "route_id"=>$route->id, 'title'=>'Ajouter une croix à mon carnet', 'method'=>'POST', 'callback'=>'reloadRouteCarnetTab']) !!} class="btn-flat waves-effect text-cursor btn-add-in-cross-book btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">repeat</i> Ajouter une répétition</a>
        </div>
    @endif

</div>
