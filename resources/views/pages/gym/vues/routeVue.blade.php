@inject('Helpers','App\Lib\HelpersTemplates')
<div class="row title-and-return">
    <div class="col s12">
        <div class="col s5">
            <h5 class="loved-king-font no-warp">
                @if($route->hasThumbnail())
                    <img src="{{ $route->thumbnail() }}" class="circle left thumbnail-route">
                @endif
                <div class="left">
                    @foreach($route->colors() as $color)
                        <div class="z-depth-2" style="background-color: {{ $color }}; height: 0.4em; width: 0.4em; border-radius: 50%; margin-right: 0.5em; margin-top: 2px"></div>
                    @endforeach
                </div>
                {!! $route->grades('html', 'text-bold') !!}
                {{ $route->label }}
            </h5>
        </div>
        <div class="col s7 text-right">
            <button onclick="getGymSector({{ $route->sector->id }}, '{{ $route->sector->label }}'); animationLoadSideNav('l')" class="btn btn-flat waves-effect waves-light" type="submit" name="action">
                <i class="material-icons left">keyboard_arrow_left</i>
            </button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        @if($route->description != '')
            <p class="grey-text">
                <i class="material-icons left" style="font-size: 1.4em">reorder</i>
                {{ $route->description }}
            </p>
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
            </table>
        @endif

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
                                <div class="markdownZone">
                                    @markdown($cross->description)
                                </div>
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
        @if($route->hasPicture())
            <div>
                <img src="{{ $route->picture(500) }}" class="responsive-img">
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
            <button {!! $Helpers::modal(route('gymRouteModal', ["gym_id"=>$gym->id]), ["id" => $route->id, "room_id"=>$room->id, "gym_id"=>$gym->id, "sector_id"=>$route->sector_id, "title"=> trans('pages/gym-schemes/global.editRoute'), "method"=>"PUT", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                @lang('pages/gym-schemes/global.editRoute')
                <i class="material-icons left">edit</i>
            </button>
            <button {!! $Helpers::modal(route('routeUploadSchemeModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.uploadPicture'), "method"=>"POST", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                @lang('pages/gym-schemes/global.uploadPicture')
                <i class="material-icons left">photo_camera</i>
            </button>
            <button {!! $Helpers::modal(route('routeUploadThumbnailModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.uploadThumbnail'), "method"=>"POST", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                @lang('pages/gym-schemes/global.uploadThumbnail')
                <i class="material-icons left">crop_original</i>
            </button>
            <button class="btn btn-flat btn" onclick="dismountRoute({{ $route->id }})">
                @if($route->dismounted_at == null)
                    @lang('pages/gym-schemes/global.dismountRoute')
                    <i class="material-icons left">reply</i>
                @else
                    @lang('pages/gym-schemes/global.riseUpRoute')
                    <i class="material-icons left">keyboard_capslock</i>
                @endif
            </button>
            <button class="btn btn-flat btn" onclick="favoriteRoute({{ $route->id }})">
                @if($route->favorite)
                    @lang('pages/gym-schemes/global.favoriteRoute')
                    <i class="material-icons left red-text">favorite</i>
                @else
                    @lang('pages/gym-schemes/global.upToFavoriteRoute')
                    <i class="material-icons left">favorite_border</i>
                @endif
            </button>
        </div>
    </div>
@endif
