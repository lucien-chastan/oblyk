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
            L.marker(
                [{{$crag['lat']}},{{$crag['lng']}}],
                {icon: marker_{{$crag['type_voie']}}{{$crag['type_grande_voie']}}{{$crag['type_bloc']}}{{$crag['type_deep_water']}}}
            )
            .bindPopup(
                '<img class="photo-couve-site-leaflet" src="/storage/photos/crags/oblyk-home-baume-rousse.jpg" alt="photo de couverture de {{$crag['label']}}"><div class="crag-leaflet-info"><h2 class="loved-king-font titre-crag-leaflet"><a href="/site-escalade/{{$crag['id']}}/{{str_slug($crag['label'])}}">{{$crag['label']}}</a></h2><span>site de voie et grande-voie, de 150 lignes</span></div>'
            ).addTo(map);
        @endforeach

        //passage de la barre de navigation en noir
        let nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>

@endsection
