<div class="row">

    {{--PAR SITE--}}
    <div class="col s12">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/profile/analytiks.nbCrossesByCragGraphTitle')</h2>
            <div class="card-chart">
                <canvas class="environment-analytiks-canvas" data-route="{{ route('cragsAnalytiksChart') }}" id="analytiks-crags" width="100" height="250"></canvas>
            </div>
        </div>
    </div>

</div>


<div class="row">

    {{--PAR RÉGIONS--}}
    <div class="col s12 l4">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/profile/analytiks.nbCrossesByRegionGraphTitle')</h2>
            <div class="card-chart">
                <canvas class="environment-analytiks-canvas" data-route="{{ route('regionsAnalytiksChart') }}" id="analytiks-regions" width="100" height="250"></canvas>
            </div>
        </div>
    </div>

    {{--PAR PAYS--}}
    <div class="col s12 l4">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/profile/analytiks.nbCrossesByCountryGraphTitle')</h2>
            <div class="card-chart">
                <canvas class="environment-analytiks-canvas" data-route="{{ route('paysAnalytiksChart') }}" id="analytiks-pays" width="100" height="250"></canvas>
            </div>
        </div>
    </div>


    {{--PAR ROCHE--}}
    <div class="col s12 l4">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/profile/analytiks.nbCrossesByRockGraphTitle')</h2>
            <div class="card-chart">
                <canvas class="environment-analytiks-canvas" data-route="{{ route('rocksAnalytiksChart') }}" id="analytiks-rocks" width="100" height="250"></canvas>
            </div>
        </div>
    </div>

</div>

<div class="row">

    {{--CARTE DES SITES DE GRIMPE--}}
    <div class="col s12">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/profile/analytiks.nbCrossesByMapGraphTitle')</h2>
            <div id="analytiks-map" class="analytiks-map"></div>
        </div>
    </div>
</div>
