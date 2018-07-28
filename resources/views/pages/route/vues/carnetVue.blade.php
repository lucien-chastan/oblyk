@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">

    @if(isset($ticklist))
        <p class="text-center">{{$route->label}} @lang('pages/routes/tabs/cross.inMyTickList') <a href="{{ Auth::user()->url() }}#tick-list">tick list</a></p>
        <p class="text-center"><a {!! $Helpers::tooltip(trans('pages/routes/tabs/cross.tooltipDeleteTick')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/tickLists/" . $ticklist->id, "callback"=>"reloadRouteCarnetTab"]) !!} class="i-cursor tooltipped btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">delete</i></a></p>
    @else
        @if(Auth::check() && count($crosses) == 0)
            <div class="text-center band-bt-add-carnet">
                <a class="btn-flat waves-effect text-cursor btn-add-in-cross-book" onclick="addInTickList({{$route->id}})"><i class="material-icons">crop_free</i> @lang('pages/routes/tabs/cross.btnAddTick')</a>
            </div>
        @endif
    @endif

    @if(count($crosses) > 0)

        <div class="blue-border-zone crosses-zone">

            <h2 class="loved-king-font">@lang('pages/routes/tabs/cross.sendListTitle')</h2>

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
                            @lang('pages/routes/tabs/cross.crossDate', ['date'=>$cross->release_at->format('d M Y')])

                            <span class="grey-text">
                                <i {!! $Helpers::modal(route('crossModal'), ["cross_id"=>$cross->id, "route_id"=>$route->id, 'title'=>trans('modals/cross.modalEditeTitle'), 'method'=>'PUT', 'callback'=>'reloadRouteCarnetTab']) !!} {!! $Helpers::tooltip(trans('modals/cross.editTooltip')) !!} onclick="$('#modal').modal('open');" class="material-icons tiny tooltipped btnModal">edit</i>
                                <i {!! $Helpers::modal(route('deleteModal'), ["route"=>"/crosses/" . $cross->id, "callback"=>"reloadRouteCarnetTab"]) !!} {!! $Helpers::tooltip(trans('modals/cross.deleteTooltip')) !!} onclick="$('#modal').modal('open');" class="material-icons tiny tooltipped btnModal">delete</i>
                            </span>
                        </p>

                        <strong>{{ $cross->crossStatus->label }}</strong>
                        @if($route->climb_id != 2 && $route->climb_id != 7 && $route->climb_id != 8)
                            , en <strong>{{ $cross->crossMode->label }}</strong>
                        @endif
                        @if($cross->crossHardness->id != 1)
                            , @lang('pages/routes/tabs/cross.IThoughtIt') <strong> @lang('elements/hardnesses.hardness_' . $cross->crossHardness->id) </strong>
                        @endif
                        <br>

                        @if($route->route_sections_count > 1)

                            {{--Si voie de plusieur longueur--}}
                            @if($route->route_sections_count == count($cross->crossSections))
                                <strong>@choice('pages/routes/tabs/cross.pitchMade', $route->route_sections_count)</strong><br>
                            @else
                                <strong>@lang('pages/routes/tabs/cross.nbPitchMade') {{ count($cross->crossSections) }}/{{ $route->route_sections_count }} :</strong>
                                <ul>
                                    @foreach($cross->crossSections as $section)
                                        <li>L.{{$section->routeSection->section_order}} <span class="text-bold color-grade-{{$section->routeSection->grade_val}}">{{$section->routeSection->grade}}{{$section->routeSection->sub_grade}}</span> ( @choice('pages/routes/tabs/cross.pitchHeight', $section->routeSection->section_height) )</li>
                                    @endforeach
                                </ul>
                            @endif

                        @endif
                        <strong>@lang('pages/routes/tabs/cross.tentative') </strong>{{ $cross->attempt }}<br>
                        <strong>@lang('pages/routes/tabs/cross.IClimbWith')</strong>
                        <span class="virgule">
                            @foreach($cross->crossUsers as $user)
                                <span><a href="{{ $user->user->url() }}">{{ $user->user->name }}</a></span>
                            @endforeach
                            <i {!! $Helpers::tooltip(trans('pages/routes/tabs/cross.editFriendsList')) !!} {!! $Helpers::modal(route('crossUserModal'), ["route"=>"/cross/users", "cross_id"=>$cross->id, "title"=>trans('pages/routes/tabs/cross.editFriendsList'), "method"=>"POST", "callback"=>"reloadRouteCarnetTab"]) !!} onclick="$('#modal').modal('open');" class="material-icons grey-text bt-add-grimpeur-on-cross tooltipped btnModal">group_add</i>
                        </span>

                        @if(isset($cross->description->description))
                            <div class="markdownZone">@if($cross->description->private == 1)<i {!! $Helpers::tooltip(trans('modals/cross.private_comment')) !!} class="material-icons left grey-text text-lighten-1 tooltipped">vpn_key</i>@endif{{ $cross->description->description }}</div>
                            @if($cross->description->note != 0)
                                <p class="no-margin">@lang('pages/routes/tabs/cross.note') <img src="/img/note_{{ $cross->description->note }}.png" height="15"></p>
                            @endif
                        @endif

                    </div>
                </div>

            @endforeach
        </div>
    @endif

    @if(count($crosses) == 0)
        <div class="text-center band-bt-add-carnet">
            <a {!! $Helpers::modal(route('crossModal'), ["cross_id"=>'', "route_id"=>$route->id, 'title'=>trans('modals/cross.modalAddTitle'), 'method'=>'POST', 'callback'=>'reloadRouteCarnetTab']) !!} class="btn-flat waves-effect text-cursor btn-add-in-cross-book btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">done</i> @lang('pages/routes/tabs/cross.btnAddCross')</a>
        </div>
    @else
        <div class="text-center band-bt-add-carnet">
            <a {!! $Helpers::modal(route('crossModal'), ["cross_id"=>'', "route_id"=>$route->id, 'title'=>trans('modals/cross.modalAddTitle'), 'method'=>'POST', 'callback'=>'reloadRouteCarnetTab']) !!} class="btn-flat waves-effect text-cursor btn-add-in-cross-book btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">repeat</i> @lang('pages/routes/tabs/cross.btnRepeatCross')</a>
        </div>
    @endif

</div>
