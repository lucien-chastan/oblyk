@inject('Helpers','App\Lib\HelpersTemplates')

<input type="hidden" value="{{ $user->id }}" id="user-id-climb-type">

@if(count($crosses) > 1)

    <div class="row">
        <div class="col s12">

            <div class="card-panel blue-card-panel card-chiffre-chart">
                <div class="row">

                    {{-- Climbing type graph --}}
                    <div class="col s12 m6 l3 text-center" id="graph-type-grimpe">
                        <label>@lang('pages/profile/crosses.titleNbCrossesByType')</label>
                        <div class="zone-graph-type-grimpe">
                            <canvas id="chart-climb-id" width="100" height="250"></canvas>
                        </div>
                    </div>

                    {{-- Crosses on somes number --}}
                    <div class="col s12 m6 l9">

                        {{-- Outdoor crosses--}}
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

                        {{-- Indoor crosses --}}
                        @if(count($indoor['crosses']) > 0)
                            <h2 class="loved-king-font titre-profile-boite-vue">
                                @if(Auth::id() == $user->id)
                                    @lang('pages/profile/crosses.myIndoorCrossesFigures')
                                @else
                                    @lang('pages/profile/crosses.otherIndoorCrossesFigures', ['name'=>$user->name])
                                @endif
                            </h2>
                            <div class="row">
                                <div class="col s6 m4 l4">
                                    <p>
                                        <i class="material-icons left">public</i>
                                        @choice('pages/profile/crosses.countryFigures', count($indoor['pays']))
                                    </p>
                                </div>
                                <div class="col s6 m4 l4">
                                    <p>
                                        <i class="material-icons left">home</i>
                                        @choice('pages/profile/crosses.gymFigures', count($indoor['gyms']))
                                    </p>
                                </div>
                                <div class="col s6 m4 l4">
                                    <p>
                                        <i class="material-icons left">nature</i>
                                        @choice('pages/profile/crosses.regionFigures', count($indoor['regions']))
                                    </p>
                                </div>
                                <div class="col s6 m4 l4">
                                    <p>
                                        <i class="material-icons left">done_all</i>
                                        @choice('pages/profile/crosses.crossesFigures', count($indoor['crosses']))
                                    </p>
                                </div>
                                <div class="col s6 m4 l4">
                                    <p>
                                        <i class="material-icons left">functions</i>
                                        @choice('pages/profile/crosses.meterFigures', $indoor['meters'])
                                    </p>
                                </div>
                                <div class="col s6 m4 l4">
                                    <p>
                                        <i class="material-icons left">vertical_align_top</i>
                                        <span class="color-grade-{{ $indoor['max_val'] }} text-bold">{{ $indoor['max_grade'] . $indoor['max_sub_grade'] }}</span> max
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col s12">
                        <table class="crosses-legend-table">
                            <tr class="grey-text header">
                                <td>Outdoor</td>
                                @if(count($indoor['crosses']) > 0)
                                    <td>Indoor</td>
                                @endif
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="legend-climb-square climb-bg-color-2"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_2')</span>
                                    <div class="legend-climb-square climb-bg-color-3"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_3')</span>
                                    <div class="legend-climb-square climb-bg-color-4"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_4')</span>
                                    <div class="legend-climb-square climb-bg-color-5"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_5')</span>
                                    <div class="legend-climb-square climb-bg-color-6"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_6')</span>
                                    <div class="legend-climb-square climb-bg-color-7"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_7')</span>
                                    <div class="legend-climb-square climb-bg-color-8"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_8')</span>
                                </td>
                                @if(count($indoor['crosses']) > 0)
                                    <td>
                                        <div class="legend-climb-square climb-bg-gym-color-0"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_3')</span>
                                        <div class="legend-climb-square climb-bg-gym-color-1"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_pan')</span>
                                        <div class="legend-climb-square climb-bg-gym-color-2"></div> <span class="label-legend-climb">@lang('elements/climbs.climb_2')</span>
                                    </td>
                                @endif
                                <td>
                                    @if(Auth::id() == $user->id)
                                        <div class="right"><a class="bt-go-to-analytiks" onclick="loadProfileRoute(document.getElementById('item-analytiks-nav'))"><i class="material-icons tiny">equalizer</i> Analytiks</a></div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if(count($indoor['crosses']) > 0)
        <div class="row indoor-and-outdoor-crosses-tabs">
            <div class="col s12">
                <ul class="tabs no-scroll-x">
                    <li class="tab col s2"><a href="#tab-outdoor" class="active"><i class="material-icons ic-tab-parametre-profile">terrain</i> Outdoor</a></li>
                    <li class="tab col s2"><a href="#tab-indoor"><i class="material-icons ic-tab-parametre-profile">home</i> Indoor</a></li>
                </ul>
            </div>
        </div>
    @endif
    <div class="row" id="tab-outdoor">
        <div class="col s12">
            <div class="card-panel blue-card-panel">
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs no-scroll-x">
                            <li class="tab col s2"><a href="#tab-site" class="active"><i class="material-icons ic-tab-parametre-profile">terrain</i> @lang('pages/profile/crosses.cragTab')</a></li>
                            <li class="tab col s2"><a href="#tab-grade"><i class="material-icons ic-tab-parametre-profile">swap_vert</i> @lang('pages/profile/crosses.gradeTab')</a></li>
                            <li class="tab col s2"><a href="#tab-pays"><i class="material-icons ic-tab-parametre-profile">public</i> @lang('pages/profile/crosses.countryTab')</a></li>
                            <li class="tab col s2"><a href="#tab-regions"><i class="material-icons ic-tab-parametre-profile">nature</i> @lang('pages/profile/crosses.regionTab')</a></li>
                            <li class="tab col s2"><a href="#tab-annee"><i class="material-icons ic-tab-parametre-profile">today</i> @lang('pages/profile/crosses.yearTab')</a></li>
                            <li class="tab col s2"><a href="#tab-type"><i class="material-icons ic-tab-parametre-profile">change_history</i> @lang('pages/profile/crosses.typeTab')</a></li>
                        </ul>
                    </div>
                    <div id="tab-site" class="col s12">
                        @include('pages.profile.partials.croix.tabs.cragsTab')
                    </div>
                    <div id="tab-grade" class="col s12">
                        @include('pages.profile.partials.croix.tabs.gradeTab')
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
                    <div id="tab-type" class="col s12">
                        @include('pages.profile.partials.croix.tabs.typeTab')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($indoor['crosses']) > 0)
        <div class="row" id="tab-indoor">
            <div class="col s12">
                <div class="card-panel blue-card-panel">
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs no-scroll-x">
                                <li class="tab col s2"><a href="#tab-gym-gym" class="active"><i class="material-icons ic-tab-parametre-profile">home</i> @lang('pages/profile/crosses.gymTab')</a></li>
                                <li class="tab col s2"><a href="#tab-gym-grade"><i class="material-icons ic-tab-parametre-profile">swap_vert</i> @lang('pages/profile/crosses.gradeTab')</a></li>
                                <li class="tab col s2"><a href="#tab-gym-pays"><i class="material-icons ic-tab-parametre-profile">public</i> @lang('pages/profile/crosses.countryTab')</a></li>
                                <li class="tab col s2"><a href="#tab-gym-regions"><i class="material-icons ic-tab-parametre-profile">nature</i> @lang('pages/profile/crosses.regionTab')</a></li>
                                <li class="tab col s2"><a href="#tab-gym-annee"><i class="material-icons ic-tab-parametre-profile">today</i> @lang('pages/profile/crosses.yearTab')</a></li>
                                <li class="tab col s2"><a href="#tab-gym-type"><i class="material-icons ic-tab-parametre-profile">change_history</i> @lang('pages/profile/crosses.typeTab')</a></li>
                            </ul>
                        </div>
                        <div id="tab-gym-gym" class="col s12">
                            @include('pages.profile.partials.croix.indoor-tabs.gymsTab')
                        </div>
                        <div id="tab-gym-grade" class="col s12">
                            @include('pages.profile.partials.croix.indoor-tabs.gradeTab')
                        </div>
                        <div id="tab-gym-pays" class="col s12">
                            @include('pages.profile.partials.croix.indoor-tabs.paysTab')
                        </div>
                        <div id="tab-gym-regions" class="col s12">
                            @include('pages.profile.partials.croix.indoor-tabs.regionsTab')
                        </div>
                        <div id="tab-gym-annee" class="col s12">
                            @include('pages.profile.partials.croix.indoor-tabs.yearsTab')
                        </div>
                        <div id="tab-gym-type" class="col s12">
                            @include('pages.profile.partials.croix.indoor-tabs.typeTab')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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