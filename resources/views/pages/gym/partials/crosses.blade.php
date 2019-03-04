@inject('Helpers','App\Lib\HelpersTemplates')
@php($gymIntegration = (isset($gymIntegration) && $gymIntegration))
<table class="highlight td-clickable">
    <thead>
        <tr>
            <th></th>
            <th>@lang('pages/gym-schemes/global.tableGrade')</th>
            <th>@lang('pages/gym-schemes/global.tableHeight')</th>
            <th>@lang('pages/gym-schemes/global.tableMode')</th>
            <th>@lang('pages/gym-schemes/global.tableType')</th>
            <th>@lang('pages/gym-schemes/global.tableLine')</th>
            <th class="text-right">
                @if($gymIntegration)
                    <a href="{{ Auth::user()->url() }}#analytiks" class="waves-effect waves-light btn-flat blue-text">
                        <i class="material-icons left">equalizer</i>Analytiks
                    </a>
                    <button class="waves-effect waves-light btn-flat btnModal blue-text" {!! $Helpers::modal(route('indoorCrossModal'), ["id" => "", "route_id"=>null, "room_id"=>null, "gym_id"=>$gym->id, "sector_id"=>null, "title"=> trans('pages/gym-schemes/global.addCrossGym'), "method"=>"POST"]) !!}>
                        <i class="material-icons left">done</i>@lang('pages/gyms/tabs/information.addCross')
                    </button>
                @endif
            </th>
        </tr>
    </thead>
    @php($current_cross_date = null)
    @foreach($crosses as $cross)
        @if($current_cross_date == null || $current_cross_date != $cross->release_at->format('d/m/Y'))
            @php($current_cross_date = $cross->release_at->format('d/m/Y'))
            <tr class="tr-open-at" title="{{ $cross->release_at->format('d/m/Y') }}">
                <td colspan="8" class="grey-text">{{ $cross->release_at->diffForHumans() }}</td>
            </tr>
        @endif
        <tr>
            <td>
                <i title="Prises" class="material-icons left" style="{{ $cross->color_style() }}; margin-right: 0">bubble_chart</i>
            </td>
            <td><span class="color-grade-{{ $cross->grade_val }}">{{ $cross->grade }}{{ $cross->sub_grade }}</span></td>
            <td>{{ $cross->height }}m</td>
            <td><i class="material-icons">{{ App\CrossStatus::icon($cross->status_id) }}</i></td>
            <td>
                @lang('elements/gymRouteType.type_' . $cross->type)
                @if($cross->type === 2)
                    , @lang('elements/modes.mode_' . $cross->mode_id)
                @endif
            </td>
            <td class="no-warp">
                @if($cross->hasRoom())
                    <a href="{{ $cross->room->url() }}">
                        <img height="30" src="{{ $cross->room->gym->logo(50) }}">
                    </a>
                @elseif($cross->hasGym())
                    <a href="{{ $cross->gym->url() }}">
                        <img height="30" src="{{ $cross->gym->logo(50) }}">
                    </a>
                @endif
                @if($cross->hasSector())
                    <i class="material-icons grey-text">navigate_next</i>
                    <a @if(!$gymIntegration) onclick="getGymSector({{ $cross->sector->id }}, '{{ $cross->sector->label }}'); animationLoadSideNav()" @endif>
                        <span style="vertical-align: top; margin-top: 7px; display: inline-block;">{{ $cross->sector->label }}</span>
                    </a>
                @endif
                @if($cross->hasRoute())
                    <i class="material-icons grey-text">navigate_next</i>
                    @if($cross->route->hasThumbnail())
                        <img src="{{ $cross->route->thumbnail() }}" class="circle" height="30" style="margin-right: 5px; margin-bottom: -3px">
                    @endif
                    <a @if(!$gymIntegration) onclick="getGymRoute({{ $cross->route->id }}, '{{ $cross->route->label }}'); animationLoadSideNav('r')" @endif>
                        <span style="vertical-align: top; margin-top: 7px; display: inline-block;">{{ ($cross->route->label !== '') ? $cross->route->label : 'sans nom' }}</span>
                    </a>
                @endif
            </td>
            <td>
                <i {!! $Helpers::modal(route('indoorCrossModal'), ["id" => $cross->id, "route_id"=>($cross->hasRoute()) ? $cross->route->id : null , "room_id"=>($cross->hasRoom()) ? $cross->room->id : null, "gym_id"=>($cross->hasGym()) ? $cross->gym->id : null, "sector_id"=>($cross->hasSector()) ? $cross->sector->id : null, "title"=> trans('pages/gym-schemes/global.editCross'), "method"=>"PUT", 'callback'=> $gymIntegration ? '' : 'reloadCrossesVue']) !!} style="font-size: 1.1em" class="material-icons right btnModal">edit</i>
                <i {!! $Helpers::modal(route('deleteModal'), ["route" => "/indoor_crosses/".$cross->id, 'callback'=> $gymIntegration ? '' : 'reloadCrossesVue']) !!} style="font-size: 1.1em" class="material-icons right btnModal red-text">delete</i>
            </td>
        </tr>
    @endforeach
</table>