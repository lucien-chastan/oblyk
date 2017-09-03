@inject('Helpers','App\Lib\HelpersTemplates')

<input type="hidden" value="{{ $user->id }}" id="user-id-climb-type">

@if(count($crosses) > 1)

    <div class="row">
        <div class="col s12">

            <div class="card-panel blue-card-panel card-chiffre-chart">
                <div class="row">

                    {{-- GRAPHE DES DIFFÉRENTS TYPE DE GRIMPE--}}
                    <div class="col s12 m6 l3 text-center" id="graph-type-grimpe">
                        <label>@lang('pages/profile/crosses.titleNbCrossesByType')</label>
                        <div class="zone-graph-type-grimpe">
                            <canvas id="chart-climb-id" width="100" height="250"></canvas>
                        </div>
                    </div>

                    {{-- CROIX EN QUELQUES CHIFFRES--}}
                    <div class="col s12 m6 l9">
                        <h2 class="loved-king-font titre-profile-boite-vue">
                            @if(Auth::id() == $user->id)
                                @lang('pages/profile/crosses.myCrossesFigures')
                            @else
                                @lang('pages/profile/crosses.otherCrossesFigures', ['name'=>$user->name])
                            @endif
                        </h2>
                        <div class="row">
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">public</i>
                                    @choice('pages/profile/crosses.countryFigures', count($pays))
                                </p>
                            </div>
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">terrain</i>
                                    @choice('pages/profile/crosses.cragFigures', count($crags))
                                </p>
                            </div>
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">nature</i>
                                    @choice('pages/profile/crosses.regionFigures', count($regions))
                                </p>
                            </div>
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">done_all</i>
                                    @choice('pages/profile/crosses.crossesFigures', count($crosses))
                                </p>
                            </div>
                            <div class="col s6 m4 l4">
                                <p>
                                    <i class="material-icons left">functions</i>
                                    @choice('pages/profile/crosses.meterFigures', $metres)
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
                        <div class="legend-climb-square climb-bg-color-2"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_2')</span>
                        <div class="legend-climb-square climb-bg-color-3"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_3')</span>
                        <div class="legend-climb-square climb-bg-color-4"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_4')</span>
                        <div class="legend-climb-square climb-bg-color-5"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_5')</span>
                        <div class="legend-climb-square climb-bg-color-6"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_6')</span>
                        <div class="legend-climb-square climb-bg-color-7"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_7')</span>
                        <div class="legend-climb-square climb-bg-color-8"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_8')</span>
                        @if(Auth::id() == $user->id)
                            <div class="right"><a class="bt-go-to-analytiks" onclick="loadProfileRoute(document.getElementById('item-analytiks-nav'))"><i class="material-icons tiny">equalizer</i> Analytiks</a></div>
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
                            <li class="tab col s3"><a href="#tab-site" class="active"><i class="material-icons ic-tab-parametre-profile">terrain</i> @lang('pages/profile/crosses.cragTab')</a></li>
                            <li class="tab col s3"><a href="#tab-pays"><i class="material-icons ic-tab-parametre-profile">public</i> @lang('pages/profile/crosses.countryTab')</a></li>
                            <li class="tab col s3"><a href="#tab-regions"><i class="material-icons ic-tab-parametre-profile">nature</i> @lang('pages/profile/crosses.regionTab')</a></li>
                            <li class="tab col s3"><a href="#tab-annee"><i class="material-icons ic-tab-parametre-profile">today</i> @lang('pages/profile/crosses.yearTab')</a></li>
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
            @lang('pages/profile/crosses.noCrosses')
        </p>
    @else
        <p class="grey-text text-center text-bold">
            @lang('pages/profile/crosses.otherNoCrosses', ['name'=>$user->name])
        </p>
    @endif

@endif