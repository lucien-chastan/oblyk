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
                        <tr onclick="getGymRoute({{ $route->id }}, '{{ $route->label }}'); animationLoadSideNav('r')">
                            @if(Auth::check())
                                <td>
                                    @if(count($route->crosses) > 0)
                                        <i class="material-icons">done</i>
                                    @endif
                                </td>
                            @endif
                            <td>
                                @if($route->hasThumbnail())
                                    <img src="{{ $route->thumbnail() }}" class="circle left" height="35">
                                @endif
                            </td>
                            <td>
                                @foreach($route->colors() as $color)
                                    <div class="z-depth-2" style="background-color: {{ $color }}; height: 0.6em; width: 0.6em; border-radius: 50%"></div>
                                @endforeach
                            </td>
                            <td><span class="color-grade-{{ $route->val_grade }}">{{ $route->grade }}{{ $route->sub_grade }}</span></td>
                            <td>{{ $route->label }}</td>
                            <td class="grey-text">
                                @if($route->isFavorite())
                                    <i style="font-size: 1em" class="material-icons right red-text">favorite</i>
                                @endif
                                @if($route->hasPicture())
                                    <i style="font-size: 1em" class="material-icons right">photo_camera</i>
                                @endif
                                @if($route->description != '')
                                    <i style="font-size: 1em" class="material-icons right">reorder</i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(Auth::check())
            <div class="col s12">
                @if($gym->userIsAdministrator(Auth::id()))
                    <a {!! $Helpers::tooltip(trans('pages/gym-schemes/global.createRoute')) !!} {!! $Helpers::modal(route('gymRouteModal', ["gym_id"=>$gym->id]), ["id" => "", "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "sector_id"=>$sector->id, "title"=> trans('pages/gym-schemes/global.createRoute'), "method"=>"POST", 'callback'=>'reloadSectorVue']) !!} class="btn-floating waves-effect waves-light blue btnModal right tooltipped"><i class="material-icons">add</i></a>
                @endif
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
            @if($sector->routes_count == 0)
                <button {!! $Helpers::modal(route('gymRouteModal', ["gym_id"=>$gym->id]), ["id" => "", "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "sector_id"=>$sector->id, "title"=> trans('pages/gym-schemes/global.createRoute'), "method"=>"POST", 'callback'=>'reloadSectorVue']) !!} class="btn btn-flat btn btnModal">
                    @lang('pages/gym-schemes/global.createRoute')
                    <i class="material-icons left">add</i>
                </button>
            @endif
            <button {!! $Helpers::modal(route('gymSectorModal', ["gym_id"=>$gym->id]), ["id" => $sector->id, "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.editSector'), "method"=>"PUT", 'callback'=>'reloadSectorVue']) !!} class="btn btn-flat btn btnModal">
                @lang('pages/gym-schemes/global.editSector')
                <i class="material-icons left">edit</i>
            </button>
            <button {!! $Helpers::modal(route('sectorUploadSchemeModal', ["gym_id"=>$gym->id, "sector_id"=>$sector->id]), ["id" => $sector->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.uploadPicture'), "method"=>"POST", 'callback'=>'reloadSectorVue']) !!} class="btn btn-flat btn btnModal">
                @lang('pages/gym-schemes/global.uploadPicture')
                <i class="material-icons left">photo_camera</i>
            </button>
            @if( $sector->area == '')
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
        </div>
    @endif
</div>
