<div class="navbar-fixed oblyk-navbar">

    {{-- Connection dropdown --}}
    <ul id="dropdown_connexion" class="dropdown-content dropD-180">
        @include('includes.nav-user')
    </ul>

    {{-- Project dropdown --}}
    <ul id="dropdown_projet" class="dropdown-content dropD-auto">
        <li><a href="{{ route('project') }}"><i class="material-icons left">landscape</i>@lang('interface/nav.theProject')</a></li>
        <li><a href="{{ route('articlesPage') }}"><i class="material-icons left">photo_album</i>@lang('interface/nav.actuality')</a></li>
        @if(config('app.active_indoor'))
            <li><a href="{{ route('indoorPresentation') }}"><i class="material-icons left">home</i>@lang('interface/nav.indoor')</a></li>
        @endif
        <li><a href="{{ route('contact') }}"><i class="material-icons left">email</i>@lang('interface/nav.contact')</a></li>
        <li><a href="{{ route('about') }}"><i class="material-icons left">donut_small</i>@lang('interface/nav.aboutUs')</a></li>
        <li><a href="{{ route('help') }}"><i class="material-icons left">school</i>@lang('interface/nav.helps')</a></li>
        <li><a href="{{ route('supportUs') }}"><i class="material-icons left red-text">favorite</i>@lang('interface/nav.supportUs')</a></li>
        <li><a href="{{ route('developer') }}"><i class="material-icons left">code</i>@lang('interface/nav.developerAndApi')</a></li>
    </ul>

    {{-- Tool dropdown --}}
    <ul id="dropdown_outils" class="dropdown-content dropD-210">
        <li><a href="{{ route('map') }}"><i class="material-icons left">map</i>@lang('interface/nav.cragMap')</a></li>
        <li><a href="{{ route('mapGym') }}"><i class="material-icons left">location_city</i>@lang('interface/nav.gymMap')</a></li>
        <li><a href="{{ route('forum') }}"><i class="material-icons left">forum</i>@lang('interface/nav.forum')</a></li>
        <li><a href="{{ route('lexique') }}"><i class="material-icons left">text_format</i>@lang('interface/nav.glossary')</a></li>
        <li><a href="{{ route('grade') }}"><i class="material-icons left">swap_vert</i>@lang('interface/nav.grade')</a></li>
        <li><a href="{{ route('indexes') }}"><i class="material-icons left">storage</i>@lang('interface/nav.dataBase')</a></li>
    </ul>

    {{-- Langagues dropdown --}}
    <ul id="dropdown_language" class="dropdown-content dropD-auto">
        @include('includes.nav-localization')
    </ul>

    {{-- Partner dropdown --}}
    <ul id="dropdown_partenaire" class="dropdown-content dropD-220">
        <li><a href="{{ route('partnerMapPage') }}"><i class="material-icons left">person_pin_circle</i>@lang('interface/nav.partnerMap')</a></li>
        <li><a href="{{ route('partnerHowPage') }}"><i class="material-icons left">school</i>@lang('interface/nav.howItWorks')</a></li>
        @if(Auth::check())
            <li class="divider"></li>
            <li><a @if(isset($user)) data-route="{{route('vuePartenaireParametresUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#partenaire-parametres"><i class="material-icons left">accessibility</i>@lang('interface/nav.howIAm')</a></li>
            <li><a @if(isset($user)) data-route="{{route('vueLieuxUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#mes-lieux"><i class="material-icons left">my_location</i>@lang('interface/nav.myPlaces')</a></li>
        @endif
    </ul>

    {{-- My Gyms dropdown --}}
    @if(Auth::check())
        @if(count(Auth::user()->myAdminGyms()) > 0)
            <ul id="dropdown_my_gyms" class="dropdown-content dropD-220">
                @foreach(Auth::user()->myAdminGyms() as $adminGym)
                    <li>
                        <a href="{{ $adminGym->gym->adminUrl() }}">
                            <img src="{{ $adminGym->gym->logo() }}" alt="logo de la salle {{ $adminGym->gym->label }}" height="22" style="margin-right: 10px" class="left">
                            {{ $adminGym->gym->label }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    @endif

    {{-- Menu --}}
    <nav>
        <div class="nav-wrapper nav-white" id="nav_barre">

            {{-- Oblyk logo --}}
            <a href="{{ route('index') }}" class="brand-logo">
                <svg version="1.1" viewBox="0 0 117.2832 76.144533" class="logo-de-oblyk" height="35px" width="60px">
                    <g transform="translate(-332.73828,-314.61719)">
                        <path id="path-logo" d="m 396.05664,314.61719 -28.34332,41.7539 33.28263,34.39055 9.65078,-13.23636 12.80994,13.23636 9.65086,-13.23635 16.91395,1e-4 z M 379.44727,377.52539 352.80859,350 332.73828,377.52539 Z" style="fill-opacity:1;fill-rule:evenodd;stroke:none;" />
                    </g>
                </svg>
                Oblyk{{ config('app.app_env') == 'beta' ? '- Beta' :'' }}
            </a>

            {{-- Smartphone icon --}}
            <a href="#" data-activates="side-nav" class="button-collapse"><i class="material-icons">menu</i> <span>Menu</span></a>

            {{-- Desktop menu --}}
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_language">{{ LaravelLocalization::getCurrentLocale() }} <i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_partenaire">@lang('interface/nav.partner') <i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_outils">@lang('interface/nav.mapAndTool') <i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_projet">@lang('interface/nav.theProject') <i class="material-icons right">arrow_drop_down</i></a></li>
                @if(Auth::check())
                    @if(count(Auth::user()->myAdminGyms()) > 0)
                        <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_my_gyms">@lang('interface/nav.myGyms') <i class="material-icons right">arrow_drop_down</i></a></li>
                    @endif
                @endif
                <li>
                    <a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_connexion">
                        @if (Auth::guest())
                            @lang('interface/nav.connect')
                        @else
                            {{ Auth::user()->name }} <span id="global-badge-notification-message" class="global-badge-in-navbar red"></span>
                        @endif
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
                <li><a href="#" data-activates="global-search" class="button-open-global-search"><i class="material-icons">search</i></a></li>
            </ul>


            {{-- Smartphone menu --}}
            <div class="side-nav" id="side-nav">
                <p class="center loved-king-font titre-nav-mobile"><a href="/">Oblyk</a></p>
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        @include('includes.nav-user-side-nav')
                    </li>
                    @if(Auth::check())
                        @if(count(Auth::user()->myAdminGyms()) > 0)
                        <li>
                            <div class="collapsible-header"><i class="material-icons">home</i>@lang('interface/nav.myGyms')</div>
                            <div class="collapsible-body">
                                <ul>
                                    @foreach(Auth::user()->myAdminGyms() as $adminGym)
                                        <li>
                                            <a href="{{ $adminGym->gym->adminUrl() }}">
                                                <img src="{{ $adminGym->gym->logo() }}" alt="logo de la salle {{ $adminGym->gym->label }}" style="margin-bottom: -6px; margin-right: 10px" height="22">
                                                {{ $adminGym->gym->label }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        @endif
                    @endif
                    <li>
                        <div data-activates="global-search" class="collapsible-header button-open-global-search">
                            <i class="material-icons">search</i>
                            @lang('interface/nav.search')
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">group</i>@lang('interface/nav.partner')</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('partnerMapPage') }}"><i class="material-icons left">person_pin_circle</i>@lang('interface/nav.partnerMap')</a></li>
                                <li><a href="{{ route('partnerHowPage') }}"><i class="material-icons left">school</i>@lang('interface/nav.howItWorks')</a></li>
                                @if(Auth::check())
                                    <li class="divider"></li>
                                    <li><a @if(isset($user)) data-route="{{route('vuePartenaireParametresUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#partenaire-parametres"><i class="material-icons left">accessibility</i>@lang('interface/nav.howIAm')</a></li>
                                    <li><a @if(isset($user)) data-route="{{route('vueLieuxUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#mes-lieux"><i class="material-icons left">my_location</i>@lang('interface/nav.myPlaces')</a></li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">map</i>@lang('interface/nav.mapAndTool')</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('map') }}"><i class="material-icons left">map</i>@lang('interface/nav.cragMap')</a></li>
                                <li><a href="{{ route('mapGym') }}"><i class="material-icons left">location_city</i>@lang('interface/nav.gymMap')</a></li>
                                <li><a href="{{ route('forum') }}"><i class="material-icons left">forum</i>@lang('interface/nav.forum')</a></li>
                                <li><a href="{{ route('lexique') }}"><i class="material-icons left">text_format</i>@lang('interface/nav.glossary')</a></li>
                                <li><a href="{{ route('grade') }}"><i class="material-icons left">swap_vert</i>@lang('interface/nav.grade')</a></li>
                                <li><a href="{{ route('indexes') }}"><i class="material-icons left">storage</i>@lang('interface/nav.dataBase')</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">landscape</i>@lang('interface/nav.theProject')</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('project') }}"><i class="material-icons left">landscape</i>@lang('interface/nav.theProject')</a></li>
                                <li><a href="{{ route('contact') }}"><i class="material-icons left">email</i>@lang('interface/nav.contact')</a></li>
                                <li><a href="{{ route('articlesPage') }}"><i class="material-icons left">photo_album</i>@lang('interface/nav.actuality')</a></li>
                                @if(config('app.active_indoor'))
                                    <li><a href="{{ route('indoorPresentation') }}"><i class="material-icons left">home</i>@lang('interface/nav.indoor')</a></li>
                                @endif
                                <li><a href="{{ route('about') }}"><i class="material-icons left">donut_small</i>@lang('interface/nav.aboutUs')</a></li>
                                <li><a href="{{ route('help') }}"><i class="material-icons left">school</i>@lang('interface/nav.helps')</a></li>
                                <li><a href="{{ route('supportUs') }}"><i class="material-icons left red-text">favorite</i>@lang('interface/nav.supportUs')</a></li>
                                <li><a href="{{ route('developer') }}"><i class="material-icons left">code</i>@lang('interface/nav.developerAndApi')</a></li>
                                <li><a href="{{ route('termsOfUse') }}"><i class="material-icons left">gavel</i>@lang('interface/nav.TermsOfService ')</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
