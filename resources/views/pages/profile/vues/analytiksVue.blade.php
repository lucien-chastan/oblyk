@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

<div class="analytiks">
    <div class="row zone-analytiks-tabs">
        <div class="col s12">
            <div class="card-panel blue-card-panel">
                <div class="row">
                    <div class="col s12">
                        @include('pages.profile.partials.analytiks.tabs')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row zone-analytiks-box">
        <div id="analytiks-tab-route">
            @include('pages.profile.partials.analytiks.tabs.routeAnalytiks')
        </div>
        <div id="analytiks-tab-lieux">
            @include('pages.profile.partials.analytiks.tabs.environmentAnalytiks')
        </div>
        <div id="analytiks-tab-time">
            @include('pages.profile.partials.analytiks.tabs.timeAnalytiks')
        </div>
        <div id="analytiks-tab-filter">
            @include('pages.profile.partials.analytiks.tabs.filterAnalytiks')
        </div>
    </div>
</div>
