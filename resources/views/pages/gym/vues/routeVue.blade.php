@inject('Helpers','App\Lib\HelpersTemplates')
<div class="row title-and-return">
    <div class="col s12">
        <div class="col s5">
            <h5 class="loved-king-font no-warp">
                @if($route->hasThumbnail())
                    <img src="{{ $route->thumbnail() }}" class="circle left thumbnail-route">
                @endif
                <div class="left" style="margin-right: 0.5em; margin-top: 2px">
                    @if($route->display_tag_color())
                        <i title="Étiquettes" class="material-icons left" style="{{ $route->tag_color_style() }}; margin-right: 0">turned_in</i>
                    @endif
                    @if($route->display_hold_color())
                        <i title="Prises" class="material-icons left" style="{{ $route->hold_color_style() }}; margin-right: 0">bubble_chart</i>
                    @endif
                </div>
                {!! $route->grades('html', 'text-bold') !!}
                {{ $route->label }}
            </h5>
        </div>
        <div class="col s7 text-right">
            <button onclick="getGymSector({{ $route->sector->id }}); animationLoadSideNav('l')" class="btn btn-flat waves-effect waves-light" type="submit" name="action">
                <i class="material-icons left">keyboard_arrow_left</i>
            </button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">

        {{-- Description --}}
        @if($route->description != '')
            <p class="grey-text">
                <i class="material-icons left" style="font-size: 1.4em">reorder</i>
                {{ $route->description }}
            </p>
        @endif

        {{-- Information --}}
        <table class="information-route-tab">
            <tr>
                <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.type') :</th>
                <td>{!! $route->formatted_type('text-bold') !!}</td>
            </tr>
            <tr>
                <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.height') :</th>
                <td>
                    @foreach($route->heights() as $height)
                        {{ $height }}m
                    @endforeach
                </td>
            </tr>
            @if($route->reference != '')
                <tr>
                    <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.ref') :</th>
                    <td>
                        {{ $route->reference }}
                    </td>
                </tr>
            @endif
            <tr>
                <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.ascent') :</th>
                <td>@choice('pages/gym-schemes/global.number_ascent', $route->number_of_ascents())</td>
            </tr>
            @if($route->opener)
                <tr>
                    <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.openedBy') :</th>
                    <td>
                        {{ $route->opener }}
                    </td>
                </tr>
            @endif
            <tr>
                <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.openedAt') :</th>
                <td>
                    {{ $route->opener_date->format('d/m/Y') }}
                </td>
            </tr>
            <tr>
                <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.sector') :</th>
                <td>
                    <a onclick="getGymSector({{ $route->sector->id }}); animationLoadSideNav()">{{ $route->sector->label }}</a>
                </td>
            </tr>
            <tr>
                <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.link') :</th>
                <td>
                    <a href="{{ $route->url()}}" target="_blank">@lang('pages/gym-schemes/global.see_separately')</a>
                </td>
            </tr>
        </table>

        {{-- Cross --}}
        @if(Auth::check())
            @if(count($user_crosses) > 0)
                <p class="grey-text text-underline">@lang('pages/gym-schemes/global.crossesTitle')</p>
                <div class="blue-border-zone">
                    @foreach($user_crosses as $cross)
                        <div class="blue-border-div">
                            <p>
                                @lang('elements/statuses.status_' . $cross->status_id) le {{ $cross->release_at->format('d/m/Y') }}, fait en @lang('elements/modes.mode_' . $cross->mode_id)
                                <i {!! $Helpers::modal(route('indoorCrossModal'), ["id" => $cross->id, "route_id"=>$route->id, "room_id"=>$room->id, "gym_id"=>$gym->id, "sector_id"=>$route->sector_id, "title"=> trans('pages/gym-schemes/global.editCross'), "method"=>"PUT", 'callback'=>'reloadRouteVue']) !!} style="font-size: 1.1em" class="material-icons right btnModal">edit</i>
                                <i {!! $Helpers::modal(route('deleteModal'), ["route" => "/indoor_crosses/".$cross->id, 'callback'=>'reloadRouteVue']) !!} style="font-size: 1.1em" class="material-icons right btnModal red-text">delete</i>
                            </p>
                            @if($cross->description != null)
                                <div class="markdownZone">@markdown($cross->description)</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="text-center">
                <button {!! $Helpers::modal(route('indoorCrossModal'), ["id" => "", "route_id"=>$route->id, "room_id"=>$room->id, "gym_id"=>$gym->id, "sector_id"=>$route->sector_id, "title"=> trans('pages/gym-schemes/global.addCross'), "method"=>"POST", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                    @if(count($user_crosses) == 0)
                        @lang('pages/gym-schemes/global.addCross')
                    @else
                        @lang('pages/gym-schemes/global.addRepetitionCross')
                    @endif
                    <i class="material-icons left">done</i>
                </button>
            </div>
        @endif

        {{-- Picture --}}
        @if($route->hasPicture())
            <div>
                <img alt="photo de la ligne {{ $route->name() }}" src="{{ $route->picture(500) }}" class="responsive-img">
            </div>
        @endif

        {{-- Comments --}}
        <div class="blue-border-zone">
            @foreach ($route->descriptions as $description)
                <div class="blue-border-div">
                    <div class="markdownZone">{{ $description->description }}</div>
                    <p class="info-user grey-text">
                        @lang('modals/description.postByDate', ['name'=>$description->user->name, 'url'=>$description->user->url(), 'date'=>$description->created_at->format('d M Y')])
                        @if(Auth::check())
                            <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal" onclick="$('#modal').modal('open');">flag</i>
                            @if($description->user_id == Auth::id())
                                <i {!! $Helpers::tooltip(trans('modals/description.editTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$route->id, "descriptive_type"=>"GymRoute", "description_id"=>$description->id, "title"=>trans('modals/description.modalEditeTitle'), "method" => "PUT", "callback"=>"reloadRouteVue"]) !!} class="material-icons tiny-btn right tooltipped btnModal" onclick="$('#modal').modal('open');">edit</i>
                                <i {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id, "callback"=>"reloadRouteVue"]) !!} class="material-icons tiny-btn right tooltipped btnModal" onclick="$('#modal').modal('open');">delete</i>
                            @endif
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
        @if(Auth::check())
            <div class="text-center">
                <button {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$route->id, "descriptive_type"=>'GymRoute', "description_id"=>"", "title"=>trans('modals/comment.addTooltip'), "method"=>"POST", "callback"=>"reloadRouteVue"]) !!} class="btn btn-flat btnModal">@lang('modals/comment.addTooltip')<i class="material-icons left">comment</i></button>
            </div>
        @endif
    </div>
</div>
@if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
    <div class="row">
        <div class="col s12 top-border">
            <p><i class="material-icons left blue-text">settings</i><strong>@lang('pages/gym-schemes/global.administrationTitle')</strong></p>
        </div>
        <div class="col s12 administration-area">

            {{-- Edit route --}}
            <button {!! $Helpers::modal(route('gymRouteModal', ["gym_id"=>$gym->id]), ["id" => $route->id, "room_id"=>$room->id, "gym_id"=>$gym->id, "sector_id"=>$route->sector_id, "title"=> trans('pages/gym-schemes/global.editRoute'), "method"=>"PUT", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                @lang('pages/gym-schemes/global.editRoute')
                <i class="material-icons left">edit</i>
            </button>

            {{-- Upload picture --}}
            <button {!! $Helpers::modal(route('routeUploadSchemeModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.uploadPicture'), "method"=>"POST", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                @lang('pages/gym-schemes/global.uploadPicture')
                <i class="material-icons left">photo_camera</i>
            </button>

            {{-- Upload thumbnail --}}
            <button {!! $Helpers::modal(route('routeUploadThumbnailModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.uploadThumbnail'), "method"=>"POST", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                @lang('pages/gym-schemes/global.uploadThumbnail')
                <i class="material-icons left">crop_original</i>
            </button>

            {{-- Crop thumbnail --}}
            @if($route->hasPicture())
                <button {!! $Helpers::modal(route('cropGymRouteModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.cropThumbnail'), "method"=>"POST", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                    @lang('pages/gym-schemes/global.cropThumbnail')
                    <i class="material-icons left">crop</i>
                </button>
            @endif

            {{-- Trace line --}}
            @if($route->line == '')
                <button class="btn btn-flat start-edition-btn" onclick="startNewRouteLine({{ $route->id }})">
                    @lang('pages/gym-schemes/global.createRouteLine')
                    <i class="material-icons left">show_chart</i>
                </button>
            @else
                <button class="btn btn-flat start-edition-btn" onclick="startEditRoute({{ $route->id }})">
                    @lang('pages/gym-schemes/global.editRouteLine')
                    <i class="material-icons left">show_chart</i>
                </button>
            @endif

            {{-- Favorite --}}
            <button class="btn btn-flat btn" onclick="favoriteRoute({{ $route->id }})">
                @if($route->favorite)
                    @lang('pages/gym-schemes/global.favoriteRoute')
                    <i class="material-icons left red-text">favorite</i>
                @else
                    @lang('pages/gym-schemes/global.upToFavoriteRoute')
                    <i class="material-icons left">favorite_border</i>
                @endif
            </button>

            {{-- Dismonte route --}}
            <button class="btn btn-flat btn" onclick="dismountRoute({{ $route->id }})">
                @if($route->dismounted_at == null)
                    @lang('pages/gym-schemes/global.dismountRoute')
                    <i class="material-icons left red-text">reply</i>
                @else
                    @lang('pages/gym-schemes/global.riseUpRoute')
                    <i class="material-icons left">keyboard_capslock</i>
                @endif
            </button>

            {{-- Delete photo --}}
            @if($route->hasPicture())
                <button class="btn btn-flat btn" onclick="deleteRoutePicture({{ $route->id }})">
                    @lang('pages/gym-schemes/global.deletePhoto')
                    <i class="material-icons left red-text">photo_camera</i>
                </button>
            @endif
        </div>
    </div>
@endif

<input type="hidden" id="route-name-for-ajax" value="{{ $route->name() }}">