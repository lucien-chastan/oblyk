@inject('Helpers','App\Lib\HelpersTemplates')

@if($sector->routes_count > 0)
    <div class="row title-and-return">
        <div class="col s12">
            <div class="col s5">
                <p><i class="material-icons left blue-text">timeline</i><strong>@lang('pages/gym-schemes/global.routesTitle')</strong></p>
            </div>
            <div class="col s7 text-right">
                <button onclick="getSectors(); animationLoadSideNav('l')" class="btn btn-flat waves-effect waves-light" type="submit" name="action">
                    <i class="material-icons left">keyboard_arrow_left</i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <table class="highlight td-clickable">
                <tbody>
                    @foreach($sector->routes as $route)
                        <tr onmouseover="overMapLine({{ $route->id }})" onmouseleave="leaveMapLine({{ $route->id }})" onclick="getGymRoute({{ $route->id }}); animationLoadSideNav('r')">
                            <td width="10">
                                @if($route->hasThumbnail())
                                    <img src="{{ $route->thumbnail() }}" class="circle left" height="45">
                                @endif
                            </td>
                            <td width="1">
                                @if($route->display_tag_color())
                                    <i title="Étiquettes" class="material-icons left" style="{{ $route->tag_color_style() }}; margin-right: 0">turned_in</i>
                                @endif
                                @if($route->display_hold_color())
                                    <i title="Prises" class="material-icons left" style="{{ $route->hold_color_style() }}; margin-right: 0">bubble_chart</i>
                                @endif
                            </td>
                            <td>
                                <span class="no-warp truncate">
                                    @if(Auth::check() && count($route->crosses) > 0)
                                        <i title="@lang('pages/gym-schemes/global.isDone')" class="material-icons this-route-is-done">done</i>
                                    @endif
                                    {!! $route->grades('html', 'text-bold') !!}
                                    {{ ($route->label != '') ? $route->label : $route->reference }}
                                </span>
                                <p class="grey-text no-margin">
                                    @if($route->label != '')
                                        <span class="small grey-text">{{ $route->reference }}</span>
                                    @endif
                                    @if($route->isFavorite())
                                        <i title="@lang('pages/gym-schemes/global.isFavorite')" class="material-icons red-text gym-route-mini-icon">favorite</i>
                                    @endif
                                    @if($route->hasPicture())
                                        <i title="@lang('pages/gym-schemes/global.hasPicture')" class="material-icons gym-route-mini-icon">photo_camera</i>
                                    @endif
                                    @if($route->description != '')
                                        <i title="@lang('pages/gym-schemes/global.hasDescription')" class="material-icons gym-route-mini-icon">reorder</i>
                                    @endif
                                    @if($route->descriptions_count > 0)
                                        <i title="@lang('pages/gym-schemes/global.hasComment')" class="material-icons gym-route-mini-icon">comment</i>
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(Auth::check())
            @if($gym->userIsAdministrator(Auth::id()))
                <div class="col s12 text-right">
                    <button {!! $Helpers::modal(route('gymRouteModal', ["gym_id"=>$gym->id]), ["id" => "", "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "sector_id"=>$sector->id, "title"=> trans('pages/gym-schemes/global.createRoute'), "method"=>"POST", 'callback'=>'reloadSectorVue']) !!} class="btn btn-flat btnModal">
                        @lang('pages/gym-schemes/global.createRoute')
                        <i class="material-icons left">add</i>
                    </button>
                </div>
            @endif

            <div class="col s12">
                <a {!! $Helpers::tooltip(trans('pages/gym-schemes/global.addCrossSector')) !!} {!! $Helpers::modal(route('indoorCrossModal'), ["id" => "", "route_id"=>null, "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "sector_id"=>$sector->id, "title"=> trans('pages/gym-schemes/global.addCrossSector'), "method"=>"POST", 'callback'=>'reloadSectorVue']) !!} class="btn-floating waves-effect waves-light blue btnModal right tooltipped"><i class="material-icons">done</i></a>
            </div>
        @endif
    </div>
@endif

@if(Auth::check() && count($sector->crosses) > 0)
    <div class="row top-border" style="margin-bottom: 0">
        <div class="col s12 grey-text text-bold text-center">
            <p onclick="getGymCrosses()">
                @lang('pages/gym-schemes/global.myCrossInThisSector', ['count' => count($sector->crosses)])
            </p>
        </div>
    </div>
@endif

<div class="row title-and-return {{ ($sector->routes_count > 0) ? 'top-border' : '' }}">
    <div class="col s12">
        <div class="col no-warp {{ ($sector->routes_count == 0) ? 's5' : 's12' }}">
            <p><i class="material-icons left blue-text">info</i><strong>@lang('pages/gym-schemes/global.informationTitle')</strong></p>
        </div>
        @if($sector->routes_count == 0)
            <div class="col s7 text-right">
                <button onclick="getSectors(); animationLoadSideNav('l')" class="btn btn-flat waves-effect waves-light" type="submit" name="action">
                    <i class="material-icons left">keyboard_arrow_left</i>
                </button>
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div>
        <div class="col {{ ($sector->routes_count == 0) ? 's12' : 's10' }}">
            @markdown($sector->description)
        </div>
        @if($sector->routes_count > 0)
            <div class="col s2 grey-text">
                <p title="hauteur du secteur">{{ $sector->height }}m</p>
            </div>
        @endif
    </div>
    <div class="col s12">
        @if(Auth::check() && $sector->routes_count == 0)
            <a {!! $Helpers::tooltip(trans('pages/gym-schemes/global.addCrossSector')) !!} {!! $Helpers::modal(route('indoorCrossModal'), ["id" => "", "route_id"=>null, "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "sector_id"=>$sector->id, "title"=> trans('pages/gym-schemes/global.addCrossSector'), "method"=>"POST", 'callback'=>'reloadSectorVue']) !!} class="btn-floating waves-effect waves-light blue btnModal right tooltipped"><i class="material-icons">done</i></a>
        @endif
    </div>
    @if($sector->hasPicture())
        <div class="col s12">
            <img src="{{ $sector->picture(500) }}" class="responsive-img smooth-radius-image" id="sector-image-{{ $sector->id }}">
        </div>
    @endif
</div>

<div class="row">
    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
        <div class="col s12 top-border">
            <p><i class="material-icons left blue-text">settings</i><strong>Administration</strong></p>
        </div>
        <div class="col s12 administration-area">

            {{-- Add route --}}
            @if($sector->routes_count == 0)
                <button {!! $Helpers::modal(route('gymRouteModal', ["gym_id"=>$gym->id]), ["id" => "", "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "sector_id"=>$sector->id, "title"=> trans('pages/gym-schemes/global.createRoute'), "method"=>"POST", 'callback'=>'reloadSectorVue']) !!} class="btn btn-flat btnModal">
                    @lang('pages/gym-schemes/global.createRoute')
                    <i class="material-icons left">add</i>
                </button>
            @endif

            {{-- Edit sector --}}
            <button {!! $Helpers::modal(route('gymSectorModal', ["gym_id"=>$gym->id]), ["id" => $sector->id, "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.editSector'), "method"=>"PUT", 'callback'=>'reloadSectorVue']) !!} class="btn btn-flat btnModal">
                @lang('pages/gym-schemes/global.editSector')
                <i class="material-icons left">edit</i>
            </button>

            {{-- Upload photo --}}
            <button {!! $Helpers::modal(route('sectorUploadSchemeModal', ["gym_id"=>$gym->id, "sector_id"=>$sector->id]), ["id" => $sector->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.uploadPicture'), "method"=>"POST", 'callback'=>'reloadSectorVue']) !!} class="btn btn-flat btnModal">
                @lang('pages/gym-schemes/global.uploadPicture')
                <i class="material-icons left">photo_camera</i>
            </button>

            {{-- Draw area --}}
            @if($sector->area == '')
                <button class="btn btn-flat start-edition-btn" onclick="startNewSector({{ $sector->id }})">
                    @lang('pages/gym-schemes/global.createSectorArea')
                    <i class="material-icons left">crop_free</i>
                </button>
            @else
                <button class="btn btn-flat start-edition-btn" onclick="startEditSector({{ $sector->id }})">
                    @lang('pages/gym-schemes/global.editSectorArea')
                    <i class="material-icons left">crop_free</i>
                </button>
            @endif

            {{-- Delete sector --}}
            <button {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/gym_sectors/" . $sector->id, "callback" => "afterDeleteSector"]) !!} class="btnModal btn btn-flat">
                @lang('pages/gym-schemes/global.deleteSector')
                <i class="material-icons left red-text">delete</i>
            </button>

            {{-- Delete photo --}}
            @if($sector->hasPicture())
                <button class="btn btn-flat btn" onclick="deleteSectorPicture({{ $sector->id }})">
                    @lang('pages/gym-schemes/global.deletePhoto')
                    <i class="material-icons left red-text">photo_camera</i>
                </button>
            @endif
        </div>
    @endif
</div>

<input type="hidden" id="sector-name-for-ajax" value="{{ $sector->label }}">