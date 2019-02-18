<div class="row">

    {{--INFORMATIONS GLOBAL SUR LE SECTEUR--}}
    <div class="col s12 m6 l4">
        <p><i class="material-icons left">directions_walk</i>{{ trans_choice('pages/crags/tabs/sectors/tabs/information.approach', $sector->approach) }}</p>
        <p><i class="material-icons left">brightness_low</i> @lang('elements/suns.sun_' . $sector->sun->id)</p>
        <p><i class="material-icons left">filter_drama</i> @lang('elements/rains.rains_' . $sector->rain->id)</p>
        <p><i class="material-icons left">equalizer</i> {{$sector->routes_count}} ligne(s) @if($sector->routes_count > 1) de <strong class="color-grade-{{$sector->gapGrade->min_grade_val}}">{{$sector->gapGrade->min_grade_text}}</strong> à <strong class="color-grade-{{$sector->gapGrade->max_grade_val}}">{{$sector->gapGrade->max_grade_text}}</strong> @endif </p>
        <p>
            <i class="material-icons left">local_florist</i>
            <span class="@if($sector->season['summer'] === 1) blue-text @else text-through @endif">@lang('elements/seasons.season_e')</span> -
            <span class="@if($sector->season['autumn'] === 1) blue-text @else text-through @endif">@lang('elements/seasons.season_a')</span> -
            <span class="@if($sector->season['winter'] === 1) blue-text @else text-through @endif">@lang('elements/seasons.season_h')</span> -
            <span class="@if($sector->season['spring'] === 1) blue-text @else text-through @endif">@lang('elements/seasons.season_p')</span>
        </p>
        <p class="text-center">
            <svg class="boussole" version="1.1" viewBox="0 0 100.61393 100.61393" height="28.395487mm" width="28.395487mm">
                <g transform="translate(-299.43062,-288.93568)">
                    <path class="tooltipped" data-position="top" data-delay="50" data-tooltip="@lang('elements/orientations.orientation_n')" style="fill:@if($sector->orientation['north']){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-rule:evenodd;stroke:none" d="m 349.73758,288.93568 -11.20135,39.10561 11.20135,11.20135 0,-42.84708 9.54034,33.30673 1.66102,-1.661 z"></path>
                    <path class="tooltipped" data-position="left" data-delay="50" data-tooltip="@lang('elements/orientations.orientation_o')" style="fill:@if($sector->orientation['west']){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 338.53623,328.04129 -39.10561,11.20135 39.10561,11.20136 11.20135,-11.20136 -42.84704,0 33.30671,-9.54033 z"></path>
                    <path class="tooltipped" data-position="right" data-delay="50" data-tooltip="@lang('elements/orientations.orientation_e')" style="fill:@if($sector->orientation['east']){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-rule:evenodd;stroke:none" d="m 400.04455,339.24264 -39.10561,-11.20135 -11.20136,11.20135 42.84709,0 -33.30672,9.54034 1.66099,1.66104 z"></path>
                    <path class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="@lang('elements/orientations.orientation_s')" style="fill:@if($sector->orientation['south']){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-rule:evenodd;stroke:none" d="m 349.73758,389.54961 11.20136,-39.10561 -11.20136,-11.20136 0,42.84708 -9.54033,-33.30671 -1.66102,1.66099 z"></path>
                    <path class="tooltipped" data-position="left" data-delay="50" data-tooltip="@lang('elements/orientations.orientation_so')" style="fill:@if($sector->orientation['south_west']){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 330.74892,348.21342 -10.44405,20.46194 20.46195,-10.44405 -2.23059,-7.78731 z"></path>
                    <path class="tooltipped" data-position="left" data-delay="50" data-tooltip="@lang('elements/orientations.orientation_no')" style="fill:@if($sector->orientation['north_west']){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 340.76682,320.25398 -20.46195,-10.44405 10.44405,20.46195 7.78731,-2.23059 z"></path>
                    <path class="tooltipped" data-position="right" data-delay="50" data-tooltip="@lang('elements/orientations.orientation_ne')" style="fill:@if($sector->orientation['north_east']){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 368.72625,330.27188 10.44405,-20.46195 -20.46194,10.44406 2.23058,7.7873 z"></path>
                    <path class="tooltipped" data-position="right" data-delay="50" data-tooltip="@lang('elements/orientations.orientation_se')" style="fill:@if($sector->orientation['south_east']){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 358.70836,358.23133 20.46194,10.44403 -10.44405,-20.46194 -7.78731,2.23058 z"></path>
                </g>
            </svg>
        </p>
    </div>

    {{--GRAPHIQUE--}}
    <div class="col s12 m6 l8">
        <div class="sectorChart">
            <canvas data-sector-id="{{$sector->id}}" class="sector-graph-canvas" id="gradeSectorGraph-{{$sector->id}}"></canvas>
        </div>
    </div>
</div>

@if(Auth::check())
    <div class="row no-bottom-margin">
        <div class="col s12 text-right zone-action-secteur">
            <i {!! $Helpers::tooltip(trans('modals/sector.editTooltip')) !!} {!! $Helpers::modal(route('sectorModal'),['id' => $sector->id ,'title'=>trans('modals/sector.modalEditeTitle'),'method'=>'PUT']) !!} class="tooltipped material-icons right btnModal">edit</i>
            <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id" => $sector->id , "model"=> "Sector"]) !!} class="tooltipped material-icons right btnModal">flag</i>
            @if($sector->versions_count > 0)
                <i {!! $Helpers::tooltip(trans('modals/version.tooltip')) !!} {!! $Helpers::modal(route('versionModal'), ["id"=>$sector->id, "model"=>"Sector"]) !!} class="material-icons tooltipped btnModal">history</i>
            @endif
        </div>
    </div>
@endif