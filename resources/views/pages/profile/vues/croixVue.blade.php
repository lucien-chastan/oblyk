@inject('Helpers','App\Lib\HelpersTemplates')

<input type="hidden" value="{{ $user->id }}" id="user-id-climb-type">

@if(count($crosses) > 1)

    <div class="row">
        <div class="col s12">

            <div class="card-panel blue-card-panel card-chiffre-chart">
                <div class="row">

                    {{-- GRAPHE DES DIFFÉRENTS TYPE DE GRIMPE--}}
                    <div class="col s12 m6 l3" id="graph-type-grimpe">
                        <label>Nombre de croix par type de grimpe</label>
                        <div class="zone-graph-type-grimpe">
                            <canvas id="chart-climb-id" width="100" height="250"></canvas>
                        </div>
                    </div>

                    {{-- CROIX EN QUELQUES CHIFFRES--}}
                    <div class="col s12 m6 l9">
                        <h2 class="loved-king-font titre-profile-boite-vue">
                            @if(Auth::id() == $user->id)
                                Mes croix en quelques chiffres
                            @else
                                Les croix de {{ $user->name }} en quelques chiffres
                            @endif
                        </h2>
                        <div class="row">
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">public</i>
                                    {{ count($pays) }} Pays
                                </p>
                            </div>
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">terrain</i>
                                    {{ count($crags) }} Sites
                                </p>
                            </div>
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">nature</i>
                                    {{ count($regions) }} Regions
                                </p>
                            </div>
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">done_all</i>
                                    {{ count($crosses) }} Croix
                                </p>
                            </div>
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">functions</i>
                                    {{ $metres }} mètres grimpé
                                </p>
                            </div>
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">vertical_align_top</i>
                                    <span class="color-grade-{{$max_val}} text-bold">{{ $max_grade . $max_sub_grade }}</span> max
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col s12">
                        <div class="legend-climb-square climb-bg-color-2"></div> <span class="label-legend-climb">Bloc</span>
                        <div class="legend-climb-square climb-bg-color-3"></div> <span class="label-legend-climb">Voie</span>
                        <div class="legend-climb-square climb-bg-color-4"></div> <span class="label-legend-climb">Grande-voie</span>
                        <div class="legend-climb-square climb-bg-color-5"></div> <span class="label-legend-climb">Trad</span>
                        <div class="legend-climb-square climb-bg-color-6"></div> <span class="label-legend-climb">Artif</span>
                        <div class="legend-climb-square climb-bg-color-7"></div> <span class="label-legend-climb">Deep-water</span>
                        <div class="legend-climb-square climb-bg-color-8"></div> <span class="label-legend-climb">Via-ferrata</span>
                        @if(Auth::id() == $user->id)
                            <div class="right"><a class="bt-go-to-analytiks"><i class="material-icons tiny">equalizer</i> Analytiks</a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col s12">
            <div class="card-panel blue-card-panel">
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs no-scroll-x">
                            <li class="tab col s3"><a href="#tab-site" class="active"><i class="material-icons ic-tab-parametre-profile">terrain</i> Sites</a></li>
                            <li class="tab col s3"><a href="#tab-pays"><i class="material-icons ic-tab-parametre-profile">public</i> Pays</a></li>
                            <li class="tab col s3"><a href="#tab-regions"><i class="material-icons ic-tab-parametre-profile">nature</i> Regions</a></li>
                            <li class="tab col s3"><a href="#tab-annee"><i class="material-icons ic-tab-parametre-profile">today</i> Années</a></li>
                        </ul>
                    </div>
                    <div id="tab-site" class="col s12">
                        @include('pages.profile.partials.croix.tabs.cragsTab')
                    </div>
                    <div id="tab-pays" class="col s12">
                        @include('pages.profile.partials.croix.tabs.paysTab')
                    </div>
                    <div id="tab-regions" class="col s12">
                        @include('pages.profile.partials.croix.tabs.regionsTab')
                    </div>
                    <div id="tab-annee" class="col s12">
                        @include('pages.profile.partials.croix.tabs.yearsTab')
                    </div>
                </div>
            </div>
        </div>
    </div>

@else

    @if(Auth::id() == $user->id)
        <p class="grey-text text-center text-bold">
            Tu n'as pas encore ajouté tes croix
        </p>
    @else
        <p class="grey-text text-center text-bold">
            {{ $user->name }} n'a pas encore ajouté ses croix
        </p>
    @endif

@endif