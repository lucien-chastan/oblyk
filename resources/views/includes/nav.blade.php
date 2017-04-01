<div class="navbar-fixed oblyk-navbar">

    {{--DROPDOWN DE LA CONNEXION--}}
    <ul id="dropdown_connexion" class="dropdown-content dropD-180">
        @if (Auth::guest())
            <li><a href="{{ route('login') }}"><i class="material-icons left">person</i>Connexion</a></li>
            <li><a href="{{ route('register') }}"><i class="material-icons left">person_add</i>Créer un compte</a></li>
        @else
            <li><a href="#!"><i class="material-icons left">person</i>Mon profil</a></li>
            <li><a href="#!"><i class="material-icons left">shuffle</i>Flux</a></li>
            <li><a href="#!"><i class="material-icons left">playlist_add_check</i>Mes croix</a></li>
            <li><a href="#!"><i class="material-icons left">email</i>Messagerie</a></li>
            <li><a href="#!"><i class="material-icons left">settings</i>Paramètres</a></li>
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
        <li><a href="{{ route('help') }}"><i class="material-icons left">school</i>Aide</a></li>
        <li><a href="{{ route('supportUs') }}"><i class="material-icons left red-text">favorite</i>Nous soutenire</a></li>
        <li><a href="{{ route('developer') }}"><i class="material-icons left">code</i>Développeur &amp; API</a></li>
    </ul>

    {{--DROPDOWN DES OUTILS--}}
    <ul id="dropdown_outils" class="dropdown-content dropD-210">
        <li><a href="{{ route('map') }}"><i class="material-icons left">map</i>Carte des falaises</a></li>
        <li><a href="#!"><i class="material-icons left">forum</i>Forum</a></li>
        <li><a href="#!"><i class="material-icons left">text_format</i>Lexique</a></li>
        <li><a href="#!"><i class="material-icons left">search</i>Recherche avancée</a></li>
    </ul>

    {{--DROPDOWN DU PARTENAIRE--}}
    <ul id="dropdown_partenaire" class="dropdown-content dropD-220">
        <li><a href="#!"><i class="material-icons left">map</i>Carte des grimpeurs</a></li>
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
            <a href="#" data-activates="side-nav" class="button-collapse"><i class="material-icons">menu</i></a>

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
                            {{ Auth::user()->name }}
                        @endif
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
            </ul>

            {{--menu type mobile--}}
            <ul class="side-nav" id="side-nav">
                <li><a href="sass.html">Sass</a></li>
                <li><a href="badges.html">Components</a></li>
                <li><a href="collapsible.html">JavaScript</a></li>
            </ul>
        </div>
    </nav>
</div>

{{--<nav class="navbar navbar-default navbar-static-top">--}}
    {{--<div class="container">--}}
        {{--<div class="navbar-header">--}}

            {{--<!-- Collapsed Hamburger -->--}}
            {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">--}}
                {{--<span class="sr-only">Toggle Navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}

            {{--<!-- Branding Image -->--}}
            {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                {{--{{ config('app.name', 'Laravel') }}--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="collapse navbar-collapse" id="app-navbar-collapse">--}}
            {{--<!-- Left Side Of Navbar -->--}}
            {{--<ul class="nav navbar-nav">--}}
                {{--&nbsp;--}}
            {{--</ul>--}}

            {{--<!-- Right Side Of Navbar -->--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<!-- Authentication Links -->--}}
                {{--@if (Auth::guest())--}}
                    {{--<li><a href="{{ route('login') }}">Login</a></li>--}}
                    {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                {{--@else--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                            {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                        {{--</a>--}}

                        {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li>--}}
                                {{--<a href="{{ route('logout') }}"--}}
                                   {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                    {{--Logout--}}
                                {{--</a>--}}

                                {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                    {{--{{ csrf_field() }}--}}
                                {{--</form>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--@endif--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</nav>--}}