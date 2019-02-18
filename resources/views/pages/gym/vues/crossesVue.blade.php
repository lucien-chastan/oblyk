<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3">
                <a class="active"  href="#crosses-tab"><i class="material-icons left" style="margin-top:12px">list</i>@lang('pages/gym-schemes/global.tabTitleCrossList')</a>
            </li>
            <li class="tab col s3">
                <a href="#graphic-tab" onclick="getIndoorCharts()"><i class="material-icons left" style="margin-top:12px">equalizer</i>@lang('pages/gym-schemes/global.tabTitleGraphic')</a>
            </li>
        </ul>
    </div>
    <div id="crosses-tab" class="col s12">
        @include('pages.gym.partials.crosses')
    </div>
    <div id="graphic-tab" class="col s12">
        @include('pages.gym.partials.graphic')
    </div>
</div>