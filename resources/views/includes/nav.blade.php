<div class="navbar-fixed oblyk-navbar">

    {{--DROPDOWN DE LA CONNEXION--}}
    <ul id="dropdown_connexion" class="dropdown-content dropD-180">
        @if (Auth::guest())
            <li><a href="{{ route('login') }}"><i class="material-icons left">person</i>@lang('interface/nav.connect')</a></li>
            <li><a href="{{ route('register') }}"><i class="material-icons left">person_add</i>@lang('interface/nav.joinUs')</a></li>
        @else
            <li><a @if(isset($user)) data-route="{{route('vueDashboardUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}"><i class="material-icons left">person</i>@lang('interface/nav.myProfile')</a></li>
            <li><a @if(isset($user)) data-route="{{route('vueFilActuUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#fil-actu"><i class="material-icons left">shuffle</i>@lang('interface/nav.newsFeed') <span class="red-text badge-dropdown-navbar" id="badge-nb-new-posts"></span></a></li>
            <li><a @if(isset($user)) data-route="{{route('vueCroixUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#croix"><i class="material-icons left">playlist_add_check</i>@lang('interface/nav.myCross')</a></li>
            <li><a @if(isset($user)) data-route="{{route('vueMessagesUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#messages"><i class="material-icons left">email</i>@lang('interface/nav.messenger') <span class="red-text badge-dropdown-navbar" id="badge-nb-new-message"></span></a></li>
            <li><a @if(isset($user)) data-route="{{route('vueNotificationsUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#notifications"><i class="material-icons left">notifications</i>@lang('interface/nav.notifications') <span class="red-text badge-dropdown-navbar" id="badge-nb-new-notification"></span></a></li>
            <li><a @if(isset($user)) data-route="{{route('vueEditSettingsUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#parametres"><i class="material-icons left">settings</i>@lang('interface/nav.settings')</a></li>
            <li class="divider"></li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons left">power_settings_new</i>@lang('interface/nav.logOut')</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        @endif
    </ul>

    {{--DROPDOWN DU PROJET--}}
    <ul id="dropdown_projet" class="dropdown-content dropD-auto">
        <li><a href="{{ route('project') }}"><i class="material-icons left">landscape</i>@lang('interface/nav.theProject')</a></li>
        <li><a href="{{ route('articlesPage') }}"><i class="material-icons left">photo_album</i>@lang('interface/nav.actuality')</a></li>
{{--        <li><a href="{{ route('who') }}"><i class="material-icons left">group</i>@lang('interface/nav.whoAreWe')</a></li>--}}
        <li><a href="{{ route('contact') }}"><i class="material-icons left">email</i>@lang('interface/nav.contact')</a></li>
        <li><a href="{{ route('about') }}"><i class="material-icons left">donut_small</i>@lang('interface/nav.aboutUs')</a></li>
        <li><a href="{{ route('help') }}"><i class="material-icons left">school</i>@lang('interface/nav.helps')</a></li>
        <li><a href="{{ route('supportUs') }}"><i class="material-icons left red-text">favorite</i>@lang('interface/nav.supportUs')</a></li>
        <li><a href="{{ route('developer') }}"><i class="material-icons left">code</i>@lang('interface/nav.developerAndApi')</a></li>
    </ul>

    {{--DROPDOWN DES OUTILS--}}
    <ul id="dropdown_outils" class="dropdown-content dropD-210">
        <li><a href="{{ route('map') }}"><i class="material-icons left">map</i>@lang('interface/nav.cragMap')</a></li>
        <li><a href="{{ route('mapGym') }}"><i class="material-icons left">location_city</i>@lang('interface/nav.gymMap')</a></li>
        <li><a href="{{ route('forum') }}"><i class="material-icons left">forum</i>@lang('interface/nav.forum')</a></li>
        <li><a href="{{ route('lexique') }}"><i class="material-icons left">text_format</i>@lang('interface/nav.glossary')</a></li>
        <li><a href="{{ route('grade') }}"><i class="material-icons left">swap_vert</i>@lang('interface/nav.grade')</a></li>
        <li><a href="{{ route('indexes') }}"><i class="material-icons left">storage</i>@lang('interface/nav.dataBase')</a></li>
    </ul>

    {{--DROPDOWN DES OUTILS--}}
    <ul id="dropdown_language" class="dropdown-content dropD-auto">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li>
                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    <img class="flag-icon" src="/img/flag_{{ $localeCode }}.jpg"> {{ $properties['native'] }}
                </a>
            </li>
        @endforeach
    </ul>

    {{--DROPDOWN DU PARTENAIRE--}}
    <ul id="dropdown_partenaire" class="dropdown-content dropD-220">
        <li><a href="{{ route('partnerMapPage') }}"><i class="material-icons left">person_pin_circle</i>@lang('interface/nav.partnerMap')</a></li>
        <li><a href="{{ route('partnerHowPage') }}"><i class="material-icons left">school</i>@lang('interface/nav.howItWorks')</a></li>
        @if(Auth::check())
            <li class="divider"></li>
            <li><a @if(isset($user)) data-route="{{route('vuePartenaireParametresUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#partenaire-parametres"><i class="material-icons left">accessibility</i>@lang('interface/nav.howIAm')</a></li>
            <li><a @if(isset($user)) data-route="{{route('vueLieuxUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#mes-lieux"><i class="material-icons left">my_location</i>@lang('interface/nav.myPlaces')</a></li>
        @endif
    </ul>

    {{--MENU--}}
    <nav>
        <div class="nav-wrapper nav-white" id="nav_barre">

            {{--logo de oblyk--}}
            <a href="{{ route('index') }}" class="brand-logo">
                <svg version="1.1" viewBox="0 0 117.2832 76.144533" class="logo-de-oblyk" height="35px" width="60px">
                    <g transform="translate(-332.73828,-314.61719)">
                        <path id="path-logo" d="m 396.05664,314.61719 -28.34332,41.7539 33.28263,34.39055 9.65078,-13.23636 12.80994,13.23636 9.65086,-13.23635 16.91395,1e-4 z M 379.44727,377.52539 352.80859,350 332.73828,377.52539 Z" style="fill-opacity:1;fill-rule:evenodd;stroke:none;" />
                    </g>
                </svg>
                Oblyk{{ env('APP_ENV') == 'beta' ? '- Beta' :'' }}
            </a>

            {{--icone de menu quand on est sur smartphone--}}
            <a href="#" data-activates="side-nav" class="button-collapse"><i class="material-icons">menu</i> <span>Menu</span></a>

            {{--menu type desktop--}}
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_language">{{ LaravelLocalization::getCurrentLocale() }} <i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_partenaire">@lang('interface/nav.partner') <i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_outils">@lang('interface/nav.mapAndTool') <i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_projet">@lang('interface/nav.theProject') <i class="material-icons right">arrow_drop_down</i></a></li>
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




            {{--MENU POUR LES SMARTPHONE--}}
            <div class="side-nav" id="side-nav">
                <p class="center loved-king-font titre-nav-mobile"><a href="/">Oblyk</a></p>
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header">
                            <i class="material-icons">person</i>
                            @if (Auth::guest())
                                @lang('interface/nav.connect')
                            @else
                                {{ Auth::user()->name }}
                            @endif
                        </div>
                        <div class="collapsible-body">
                            <ul>
                                @if (Auth::guest())
                                    <li><a href="{{ route('login') }}"><i class="material-icons left">person</i>@lang('interface/nav.connect')</a></li>
                                    <li><a href="{{ route('register') }}"><i class="material-icons left">person_add</i>@lang('interface/nav.joinUs')</a></li>
                                @else
                                    <li><a @if(isset($user)) data-route="{{route('vueDashboardUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}"><i class="material-icons left">person</i>@lang('interface/nav.myProfile')</a></li>
                                    <li><a @if(isset($user)) data-route="{{route('vueFilActuUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#fil-actu"><i class="material-icons left">shuffle</i>@lang('interface/nav.newsFeed')</a></li>
                                    <li><a @if(isset($user)) data-route="{{route('vueCroixUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#croix"><i class="material-icons left">playlist_add_check</i>@lang('interface/nav.myCross')</a></li>
                                    <li><a @if(isset($user)) data-route="{{route('vueMessagesUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#messages"><i class="material-icons left">email</i>@lang('interface/nav.messenger')</a></li>
                                    <li><a @if(isset($user)) data-route="{{route('vueNotificationsUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#notifications"><i class="material-icons left">notifications</i>@lang('interface/nav.notifications')</a></li>
                                    <li><a @if(isset($user)) data-route="{{route('vueEditSettingsUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{ Auth::user()->url() }}#parametres"><i class="material-icons left">settings</i>@lang('interface/nav.settings')</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons left">power_settings_new</i>@lang('interface/nav.logOut')</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
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
{{--                                <li><a href="{{ route('who') }}"><i class="material-icons left">group</i>@lang('interface/nav.whoAreWe')</a></li>--}}
                                <li><a href="{{ route('contact') }}"><i class="material-icons left">email</i>@lang('interface/nav.contact')</a></li>
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