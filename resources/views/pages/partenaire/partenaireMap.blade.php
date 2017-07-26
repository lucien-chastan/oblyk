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
                <h2 class="loved-king-font">Liste des grimpeurs dans ma zone</h2>

                <p>Ici tu trouve une liste des grimpeurs qui partage la même zone que toi</p>



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
