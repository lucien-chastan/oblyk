@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row title-and-return">
    <div class="col s12">
        <ul class="tabs sectors-and-routes-tabs">
            <li class="tab col s6">
                <a class="active" href="#sectors-tab">
                    <i class="material-icons blue-text">filter_none</i>
                    @lang('pages/gym-schemes/global.tadSectors')
                </a>
            </li>
            @if(count($routes) > 0)
                <li class="tab col s6">
                    <a href="#routes-tab">
                        <i class="material-icons blue-text">show_chart</i>
                        @lang('pages/gym-schemes/global.tadNewRoutes')
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>

@php($current_group = null)

<div class="row" id="sectors-tab">
    <div class="col s12">
        @if (count($sectors) > 0)
            <table class="highlight td-clickable">
                <tbody>
                    @foreach($sectors as $sector)
                        @if(($current_group == null || $current_group != $sector->group_sector) && $sector->group_sector != '')
                            @php($current_group = $sector->group_sector)
                            <tr class="group-sector-row">
                                <td colspan="2" class="text-bold">{{ $sector->group_sector }}</td>
                            </tr>
                        @endif
                        <tr onmouseover="overMapSector({{ $sector->id }})" onmouseleave="leaveMapSector({{ $sector->id }})" onclick="getGymSector({{ $sector->id }}, '{{ $sector->label }}'); animationLoadSideNav()">
                            <td class="{{ $sector->group_sector != '' ? 'indent' : '' }}"><strong>{{ $sector->label }}</strong></td>
                            <td>
                                @if($sector->routes_count > 0)
                                    <span title="Nombre de ligne" class="badge">
                                        @choice('pages/gym-schemes/global.number_line', $sector->routes_count)
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-italic grey-text text-center">@lang('pages/gym-schemes/global.noSectors')</p>
        @endif
    </div>

    @if(Auth::check())
        <div class="row">
            <div class="col s12">
                <a {!! $Helpers::tooltip(trans('pages/gym-schemes/global.addCrossRoom')) !!} {!! $Helpers::modal(route('indoorCrossModal'), ["id" => "", "route_id"=>null, "room_id"=>$room->id, "gym_id"=>$gym->id, "sector_id"=>null, "title"=> trans('pages/gym-schemes/global.addCrossRoom'), "method"=>"POST", 'callback'=>'reloadSectorsVue']) !!} class="btn-floating waves-effect waves-light blue btnModal right tooltipped"><i class="material-icons">done</i></a>
            </div>
        </div>
    @endif

    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
        <div class="row">
            <div class="col s12 top-border">
                <p><i class="material-icons left blue-text">settings</i><strong>@lang('pages/gym-schemes/global.administrationTitle')</strong></p>
            </div>
            <div class="col s12 administration-area">
                <button {!! $Helpers::modal(route('gymSectorModal', ["gym_id"=>$gym->id,]), ["room_id"=>$room->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.createSector'), "method"=>"POST", 'callback'=>'reloadSectorsVue']) !!} class="btn btn-flat btn btnModal">
                    @lang('pages/gym-schemes/global.createSector')
                    <i class="material-icons left">add</i>
                </button>
            </div>
        </div>
    @endif
</div>

@if(count($routes) > 0)
    <div class="row" id="routes-tab">
        <table class="highlight td-clickable">
            @php($current_opener_date = null)
            @foreach($routes as $route)
                @if($current_opener_date == null || $current_opener_date != $route->opener_date->format('d/m/Y'))
                    @php($current_opener_date = $route->opener_date->format('d/m/Y'))
                    <tr class="tr-open-at" title="{{ $route->opener_date->format('d/m/Y') }}">
                        <td colspan="6" class="grey-text">{{ $route->opener_date->diffForHumans() }}</td>
                    </tr>
                @endif
                <tr onclick="getGymRoute({{ $route->id }}, '{{ $route->label }}'); animationLoadSideNav('r')">
                    <td>
                        @if($route->hasThumbnail())
                            <img src="{{ $route->thumbnail() }}" class="circle left" height="45">
                        @endif
                    </td>
                    <td>
                        @foreach($route->colors() as $color)
                            <div class="z-depth-2" style="background-color: {{ $color }}; height: 0.6em; width: 0.6em; border-radius: 50%"></div>
                        @endforeach
                    </td>
                    <td>{!! $route->grades('html') !!}</td>
                    <td>{{ $route->label }}</td>
                    <td>{{ $route->sector->label }}</td>
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
        </table>
    </div>
@endif

@if(Auth::check() && count($room->crosses) > 0)
    <div class="row top-border">
        <div class="col s12 grey-text text-bold text-center">
            <p onclick="getGymCrosses()">
                @lang('pages/gym-schemes/global.myCrossInThisRoom', ['count' => count($room->crosses)])
            </p>
        </div>
    </div>
@endif