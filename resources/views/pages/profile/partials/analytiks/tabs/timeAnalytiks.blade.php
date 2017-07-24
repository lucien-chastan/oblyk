<div class="row">
    <div class="col s12">
        <div class="card-panel">
            <h2 class="loved-king-font">Nombre de croix sur le temps</h2>
            <div class="card-chart">
                <canvas class="time-analytiks-canvas" data-route="{{ route('timeLinesAnalytiksChart') }}" id="analytiks-time-lines" width="100" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12 m6">
        <div class="card-panel">
            <h2 class="loved-king-font">Nombre de croix sur les anneés</h2>
            <div class="card-chart">
                <canvas class="time-analytiks-canvas" data-route="{{ route('yearsAnalytiksChart') }}" id="analytiks-years" width="100" height="250"></canvas>
            </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card-panel">
            <h2 class="loved-king-font">Nombre de croix sur les mois</h2>
            <div class="card-chart">
                <canvas class="time-analytiks-canvas" data-route="{{ route('monthsAnalytiksChart') }}" id="analytiks-months" width="100" height="250"></canvas>
            </div>
        </div>
    </div>
</div>