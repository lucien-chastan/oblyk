<div class="row">
    <div class="col s12">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/profile/analytiks.filterTitle')</h2>

            <div class="row">

                <div class="col s12 l4">
                    <p class="text-underline">@lang('pages/profile/analytiks.filterOnClimbType')</p>
                    <p class="no-margin grey-text bt-action-filter">
                        <span onclick="cocheFiltre(true,'climbsFilter')">
                            <i class="material-icons">done_all</i> @lang('pages/profile/analytiks.allDone')
                        </span>
                        <span onclick="cocheFiltre(false,'climbsFilter')">
                            <i class="material-icons">crop_square</i> @lang('pages/profile/analytiks.allUndone')
                        </span>
                    </p>
                    @foreach($climbs as $climb)
                        {!! $Inputs::checkbox(['name'=>'climbsFilter', 'value' => $climb->id, 'id'=> 'climb-filter-' . $climb->id, 'label'=>trans('elements/climbs.climb_' .$climb->id), 'checked' => ($filter_climb[$climb->id] == true) ? true : false, 'align' => 'left']) !!}
                    @endforeach
                </div>

                <div class="col s12 l4" @if($countIndoorCrosses == 0) style="display: none" @endif>
                    <p class="text-underline">@lang('pages/profile/analytiks.filterOnClimbTypeIndoor')</p>
                    <p class="no-margin grey-text bt-action-filter">
                        <span onclick="cocheFiltre(true,'indoorClimbsFilter')">
                            <i class="material-icons">done_all</i> @lang('pages/profile/analytiks.allDone')
                        </span>
                        <span onclick="cocheFiltre(false,'indoorClimbsFilter')">
                            <i class="material-icons">crop_square</i> @lang('pages/profile/analytiks.allUndone')
                        </span>
                    </p>
                    @foreach($indoorClimbs as $climb)
                        {!! $Inputs::checkbox(['name'=>'indoorClimbsFilter', 'value' => $climb, 'id'=> 'indoor-climb-filter-' . $climb, 'label'=>trans('elements/climb-gyms.climb_' .$climb), 'checked' => ($filter_indoor_climb[$climb] == true) ? true : false, 'align' => 'left']) !!}
                    @endforeach
                </div>

                <div class="col s12 l4">
                    <p class="text-underline">@lang('pages/profile/analytiks.filterOnStatusType')</p>
                    <p class="no-margin grey-text bt-action-filter">
                        <span onclick="cocheFiltre(true,'statusesFilter')">
                            <i class="material-icons">done_all</i> @lang('pages/profile/analytiks.allDone')
                        </span>
                        <span onclick="cocheFiltre(false,'statusesFilter')">
                            <i class="material-icons">crop_square</i> @lang('pages/profile/analytiks.allUndone')
                        </span>
                    </p>
                    @foreach($statuses as $status)
                        {!! $Inputs::checkbox(['name'=>'statusesFilter', 'value' => $status->id, 'id'=>'status-filter-' . $status->id, 'label'=>trans('elements/statuses.status_' . $status->id), 'checked' => ($filter_status[$status->id] == true) ? true : false, 'align' => 'left']) !!}
                    @endforeach
                </div>

                <div class="col s12">
                    <div class="switch switch-filter-period">
                        <span class="text-underline">@lang('pages/profile/analytiks.filterPeriod') </span>
                        <label>
                            @lang('pages/profile/analytiks.no')
                            @if($filter_periods['start'] != 'first' && $filter_periods['end'] != 'now')
                                <input id="switch-filter" type="checkbox" checked onchange="visibleFilterPeriod(this)">
                            @else
                                <input id="switch-filter" type="checkbox" onchange="visibleFilterPeriod(this)">
                            @endif
                            <span class="lever"></span>
                            @lang('pages/profile/analytiks.yes')
                        </label>
                    </div>
                    <div id="div-filter-period" class="row" style="{{ ($filter_periods['start'] != 'first' && $filter_periods['end'] != 'now') ? '' : 'display: none' }}">
                        <div class="col s12 l6">
                            {!! $Inputs::date(['name'=>'filterStart', 'id'=> 'climb-filter-start', 'label'=>trans('pages/profile/analytiks.startDate'), 'value'=> ($filter_periods['start'] != 'first' && $filter_periods['end'] != 'now') ? $filter_periods['start'] : date('Y-m-d')]) !!}
                        </div>
                        <div class="col s12 l6">
                            {!! $Inputs::date(['name'=>'filterEnd', 'id'=> 'climb-filter-end', 'label'=>trans('pages/profile/analytiks.endDate'), 'value'=> ($filter_periods['start'] != 'first' && $filter_periods['end'] != 'now') ? $filter_periods['end'] : date('Y-m-d')]) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {!! $Inputs::Submit(['label'=>trans('pages/profile/analytiks.submit'), 'cancelable' => false, 'onclick' => 'submitFilter()']) !!}
            </div>
        </div>
    </div>
</div>