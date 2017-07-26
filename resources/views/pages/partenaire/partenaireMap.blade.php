@extends('layouts.map')

@section('css')
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link href="/framework/leaflet/markercluster.css" rel="stylesheet">
    <link href="/css/popupMapStyle.css" rel="stylesheet">
    <link href="/css/map.css" rel="stylesheet">
    <link href="/css/partner-map.css" rel="stylesheet">
@endsection

@section('content')

    {{--contenu de la page--}}
    <div id="map"></div>

    {{--SIDE NAV QUI MONTRE LES GRIMPEURS QUI PARTAGE LA MÊME ZONE--}}
    <div id="my-user-circle-partner" class="side-user-map-partner circle-side">
        <div class="row">
            <div class="col s12">
                @if(Auth::check())

                    @if($user->partnerSettings->partner == 1)

                        @if(count($places) > 0)

                            <h2 class="loved-king-font">Qui grimpe au même endroit que moi</h2>

                            <div class="blue-border-zone">
                                @foreach($places as $place)
                                    <div title="Cliquez pour afficher sur la carte" class="blue-border-div place-div" onclick="zoomOn({{ $place->lat }}, {{ $place->lng }})">
                                        <p class="no-margin text-bold"><i class="material-icons left blue-text">location_on</i> <span class="blue-text" onclick="openProfile({{ $place->user->id }})">{{ $place->user->name }}</span> à {{$place->label}}</p>
                                        <div class="markdownZone grey-text">@markdown($place->description)</div>
                                    </div>
                                @endforeach
                            </div>

                        @else
                            <h2 class="loved-king-font text-center">Mes lieux de grimpe</h2>

                            <p>
                                Pour que nous puissions te présenter les grimpeurs autours de chez toi, il faut déjà que tu nous dise où tu grimpe.<br>
                                Rend-toi dans ton profil et renseigne ta zone de grimpe
                            </p>
                            <p class="text-center">
                                <a class="btn-flat waves-effect blue-text" href="{{ route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)]) }}#mes-lieux">Mes lieux de grimpe</a>
                            </p>
                        @endif
                    @else

                        <h2 class="loved-king-font text-center">Bienvenue {{ Auth::user()->name }} !</h2>

                        <p>
                            Bienvenue dans la recheche de partenaire d'oblyk ! pour en faire partie il faut que tu passe par 2 étapes.<br>
                            <span class="text-underline">Premièrement</span> : Active la recherche de partenaire et presente toi un peux plus.
                        </p>
                        <p class="text-center">
                            <a class="btn-flat waves-effect blue-text" href="{{ route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)]) }}#partenaire-parametres">Activation &amp; Présentation</a>
                        </p>
                    @endif
                @else
                    <p class="grey-text text-center">
                        Crée-toi un compte pour avoir accès à liste de grimpeur près de chez toi !<br>
                    </p>
                    <p class="text-center">
                        <a href="{{ route('login') }}">Connexion</a> - <a href="{{ route('register') }}">Créer un compte</a>
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{--SIDE NAV QUI MONTRE UN USTILISATEUR--}}
    <div id="side-user-map-partner" class="side-user-map-partner">
        <div id="content-side-map-partner" class="content-side-map-partner">
            mon contenu
        </div>
        <div id="load-side-map-partner" class="load-side-map-partner">
            <div class="preloader-wrapper active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red waves-effect" onclick="openVoletMyCircle(true)">
            <i class="large material-icons">filter_tilt_shift</i>
        </a>
    </div>

@endsection


@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/framework/leaflet/markercluster.js"></script>
    <script src="/js/mapVariable.js"></script>
    <script src="/js/partner.js"></script>
    <script>

        //chargement de la map
        loadPartnerMap();
        getPartnerPoints();

        @if(Auth::check() && $user->partnerSettings->partner != 0)
            getMyPlaces();
        @endif

        //passage de la barre de navigation en noir
        let nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>

@endsection
