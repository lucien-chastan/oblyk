@extends('layouts.map-gym',[
    'meta_title'=> 'Plan de la salle de laennec',
    'meta_description'=>'Description du plan de la salle de lanenec',
    'meta_img'=>'https://oblyk.org/img/map_meta.jpg',
    'gym' => $gym
])

@section('css')
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link href="/framework/leaflet/markercluster.css" rel="stylesheet">
    <link rel="stylesheet" href="/framework/leaflet/Control.Geocoder.css">
    <link rel="stylesheet" href="/framework/leaflet/leaflet.draw.css">
    <link rel="stylesheet" href="/css/gym-scheme.css">
@endsection

@section('content')

    <div id="gym-scheme"></div>

@endsection

@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/js/gym-scheme.js"></script>
    <script>
        initSchemeGymMap();

        //passage de la barre de navigation en noir
        var nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>
@endsection
