@extends('layouts.map')

@section('css')
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link href="/css/map.css" rel="stylesheet">
@endsection

@section('content')

    {{--contenu de la page--}}
    <div id="map"></div>

@endsection


@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/js/map.js"></script>
    <script>

        //chargement de la map
        loadMap();

        //boucle sur les falaises pour ajouter les marqueurs sur la carte
        @foreach($crags as $crag)
            L.marker([{{$crag['lat']}},{{$crag['lng']}}], {icon: marker_{{$crag['type_voie']}}{{$crag['type_grande_voie']}}{{$crag['type_bloc']}}{{$crag['type_deep_water']}}}).bindPopup('<a href="/site-escalade/{{$crag['id']}}/{{str_slug($crag['label'])}}">{{$crag['label']}}</a><br>').addTo(map);
        @endforeach

        //passage de la barre de navigation en noir
        let nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>

@endsection
