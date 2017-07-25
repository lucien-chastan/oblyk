<div class="navbar-fixed oblyk-navbar">

    {{--DROPDOWN DE LA CONNEXION--}}
    <ul id="dropdown_connexion" class="dropdown-content dropD-180">
        @if (Auth::guest())
            <li><a href="{{ route('login') }}"><i class="material-icons left">person</i>Connexion</a></li>
            <li><a href="{{ route('register') }}"><i class="material-icons left">person_add</i>Créer un compte</a></li>
        @else
            <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}"><i class="material-icons left">person</i>Mon profil</a></li>
            <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#fil-actu"><i class="material-icons left">shuffle</i>Fil d'actu <span class="red-text badge-dropdown-navbar" id="badge-nb-new-posts"></span></a></li>
            <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#croix"><i class="material-icons left">playlist_add_check</i>Mes croix</a></li>
            <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#messages"><i class="material-icons left">email</i>Messagerie <span class="red-text badge-dropdown-navbar" id="badge-nb-new-message"></span></a></li>
            <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#notifications"><i class="material-icons left">notifications</i>Notification <span class="red-text badge-dropdown-navbar" id="badge-nb-new-notification"></span></a></li>
            <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#parametres"><i class="material-icons left">settings</i>Paramètres</a></li>
            <li class="divider"></li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons left">power_settings_new</i>Déconnexion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        @endif
    </ul>

    {{--DROPDOWN DU PROJET--}}
    <ul id="dropdown_projet" class="dropdown-content dropD-auto">
        <li><a href="{{ route('project') }}"><i class="material-icons left">landscape</i>Le projet</a></li>
        <li><a href="{{ route('who') }}"><i class="material-icons left">group</i>Qui sommes-nous ?</a></li>
        <li><a href="{{ route('contact') }}"><i class="material-icons left">email</i>Conctact</a></li>
        <li><a href="{{ route('about') }}"><i class="material-icons left">donut_small</i>À propos</a></li>
        <li><a href="{{ route('help') }}"><i class="material-icons left">school</i>Aides</a></li>
        <li><a href="{{ route('supportUs') }}"><i class="material-icons left red-text">favorite</i>Nous soutenir</a></li>
        <li><a href="{{ route('developer') }}"><i class="material-icons left">code</i>Développeur &amp; API</a></li>
    </ul>

    {{--DROPDOWN DES OUTILS--}}
    <ul id="dropdown_outils" class="dropdown-content dropD-210">
        <li><a href="{{ route('map') }}"><i class="material-icons left">map</i>Carte des falaises</a></li>
        <li><a href="{{ route('forum') }}"><i class="material-icons left">forum</i>Forum</a></li>
        <li><a href="{{ route('lexique') }}"><i class="material-icons left">text_format</i>Lexique</a></li>
    </ul>

    {{--DROPDOWN DU PARTENAIRE--}}
    <ul id="dropdown_partenaire" class="dropdown-content dropD-220">
        <li><a href="{{ route('partnerMapPage') }}"><i class="material-icons left">person_pin_circle</i>Carte des grimpeurs</a></li>
        <li><a href="#!"><i class="material-icons left">school</i>Comment ça marche</a></li>
    </ul>

    {{--MENU--}}
    <nav>
        <div class="nav-wrapper nav-white" id="nav_barre">

            {{--logo de oblyk--}}
            <a href="/" class="brand-logo">
                <svg version="1.1" viewBox="0 0 117.2832 76.144533" class="logo-de-oblyk" height="35px" width="60px">
                    <g transform="translate(-332.73828,-314.61719)">
                        <path id="path-logo" d="m 396.05664,314.61719 -30.4043,41.7539 13.79493,21.1543 10.61132,10.96484 10.22461,-14.02343 15.76953,16.29492 9.65235,-13.23633 24.3164,0 -53.96484,-62.9082 z M 379.44727,377.52539 362.78516,360.31055 352.80859,350 l -20.07031,27.52539 46.70899,0 z" style="fill-opacity:1;fill-rule:evenodd;stroke:none;" />
                    </g>
                </svg>
                Oblyk
            </a>

            {{--icone de menu quand on est sur smartphone--}}
            <a href="#" data-activates="side-nav" class="button-collapse"><i class="material-icons">menu</i> <span>Menu</span></a>

            {{--menu type desktop--}}
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_partenaire">Partenaire<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_outils">Carte &amp; Outils<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_projet">Le projet<i class="material-icons right">arrow_drop_down</i></a></li>
                <li>
                    <a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_connexion">
                        @if (Auth::guest())
                            Connexion
                        @else
                            {{ Auth::user()->name }} <span id="global-badge-notification-message" class="global-badge-in-navbar red"></span>
                        @endif
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
                <li><a href="#" data-activates="global-search" class="button-open-global-search"><i class="material-icons">search</i></a></li>
            </ul>

            {{--menu type mobile--}}
            <div class="side-nav" id="side-nav">
                <p class="center loved-king-font titre-nav-mobile"><a href="/">Oblyk</a></p>
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header">
                            <i class="material-icons">person</i>
                            @if (Auth::guest())
                                Connexion
                            @else
                                {{ Auth::user()->name }}
                            @endif
                        </div>
                        <div class="collapsible-body">
                            <ul>
                                @if (Auth::guest())
                                    <li><a href="{{ route('login') }}"><i class="material-icons left">person</i>Connexion</a></li>
                                    <li><a href="{{ route('register') }}"><i class="material-icons left">person_add</i>Créer un compte</a></li>
                                @else
                                    <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}"><i class="material-icons left">person</i>Mon profil</a></li>
                                    <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#fil-actu"><i class="material-icons left">shuffle</i>Fil d'actu</a></li>
                                    <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#croix"><i class="material-icons left">playlist_add_check</i>Mes croix</a></li>
                                    <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#messages"><i class="material-icons left">email</i>Messagerie</a></li>
                                    <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#notifications"><i class="material-icons left">notifications</i>Notification</a></li>
                                    <li><a href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#parametres"><i class="material-icons left">settings</i>Paramètres</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons left">power_settings_new</i>Déconnexion</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">group</i>Partenaire de grimpe</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="#!"><i class="material-icons left">person_pin_circle</i>Carte des grimpeurs</a></li>
                                <li><a href="#!"><i class="material-icons left">school</i>Comment ça marche</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">map</i>Carte &amp; Outils</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('map') }}"><i class="material-icons left">map</i>Carte des falaises</a></li>
                                <li><a href="{{ route('forum') }}"><i class="material-icons left">forum</i>Forum</a></li>
                                <li><a href="{{ route('lexique') }}"><i class="material-icons left">text_format</i>Lexique</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">landscape</i>Le projet</div>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('project') }}"><i class="material-icons left">landscape</i>Le projet</a></li>
                                <li><a href="{{ route('who') }}"><i class="material-icons left">group</i>Qui sommes-nous ?</a></li>
                                <li><a href="{{ route('contact') }}"><i class="material-icons left">email</i>Conctact</a></li>
                                <li><a href="{{ route('about') }}"><i class="material-icons left">donut_small</i>À propos</a></li>
                                <li><a href="{{ route('help') }}"><i class="material-icons left">school</i>Aides</a></li>
                                <li><a href="{{ route('supportUs') }}"><i class="material-icons left red-text">favorite</i>Nous soutenir</a></li>
                                <li><a href="{{ route('developer') }}"><i class="material-icons left">code</i>Développeur &amp; API</a></li>
                                <li><a href="{{ route('termsOfUse') }}"><i class="material-icons left">gavel</i>Mentions légales</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>