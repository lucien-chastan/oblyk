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

@endsection


@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/framework/leaflet/markercluster.js"></script>
    <script src="/js/mapVariable.js"></script>
    <script src="/js/partner.js"></script>
    <script>

        //chargement de la map
        loadPartnerMap();

        //passage de la barre de navigation en noir
        let nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>

@endsection
