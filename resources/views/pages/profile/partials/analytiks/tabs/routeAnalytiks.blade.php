<div class="row">

    {{-- Grade --}}
    <div class="col s12">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/profile/analytiks.crossesGraderGraphTitle')</h2>
            <div class="card-chart">
                <canvas class="route-analytiks-canvas" data-route="{{ route('gradeAnalytiksChart') }}" id="analytiks-cotations" width="100" height="250"></canvas>
            </div>
        </div>
    </div>

</div>

<div class="row">

    {{-- Climbing type --}}
    <div class="col s12 l4">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/profile/analytiks.crossesClimbGraphTitle')</h2>
            <div class="card-chart">
                <canvas class="route-analytiks-canvas" data-route="{{ route('climbsAnalytiksChart') }}" id="analytiks-climbs" width="100" height="250"></canvas>
            </div>
        </div>
    </div>

    {{-- Status --}}
    <div class="col s12 l4">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/profile/analytiks.crossesModeGraphTitle')</h2>
            <div class="card-chart">
                <canvas class="route-analytiks-canvas" data-route="{{ route('statusesAnalytiksChart') }}" id="analytiks-statuses" width="100" height="250"></canvas>
            </div>
        </div>
    </div>

    {{-- Mode --}}
    <div class="col s12 l4">
        <div class="card-panel">
            <h2 class="loved-king-font">Croix / Mode de grimpe</h2>
            <div class="card-chart">
                <canvas class="route-analytiks-canvas" data-route="{{ route('modesAnalytiksChart') }}" id="analytiks-modes" width="100" height="250"></canvas>
            </div>
        </div>
    </div>

</div>