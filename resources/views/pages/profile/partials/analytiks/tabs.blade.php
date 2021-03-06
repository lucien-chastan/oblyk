<ul class="tabs">
    <li class="tab col s3">
        <a href="#analytiks-tab-route" class="active" onclick="getAnalytiksCharts()">
            <i class="material-icons ic-tab-parametre-profile">timeline</i>
            <span class="hide-on-small-only">@lang('pages/profile/analytiks.routeTab')</span>
        </a>
    </li>
    <li class="tab col s3">
        <a href="#analytiks-tab-lieux" onclick="getAnalytiksCharts('environment-analytiks-canvas')">
            <i class="material-icons ic-tab-parametre-profile">room</i>
            <span class="hide-on-small-only">@lang('pages/profile/analytiks.placeTab')</span>
        </a>
    </li>
    <li class="tab col s3">
        <a href="#analytiks-tab-time" onclick="getAnalytiksCharts('time-analytiks-canvas')">
            <i class="material-icons ic-tab-parametre-profile">today</i>
            <span class="hide-on-small-only">@lang('pages/profile/analytiks.timeTab')</span>
        </a>
    </li>
    <li class="tab col s3 tab-filter-analytiks">
        <a href="#analytiks-tab-filter">
            <i class="material-icons ic-tab-parametre-profile">tune</i>
            <span class="hide-on-small-only">@lang('pages/profile/analytiks.filterTab')</span>
        </a>
    </li>
</ul>