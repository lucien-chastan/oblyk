@extends('layouts.map')

@section('css')
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link href="/framework/leaflet/markercluster.css" rel="stylesheet">
    <link href="/css/map.css" rel="stylesheet">
@endsection

@section('content')

    {{--contenu de la page--}}
    <div id="map"></div>

@endsection


@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/framework/leaflet/markercluster.js"></script>
    <script src="/js/map.js"></script>
    <script>

        //chargement de la map
        loadMap();

        //boucle sur les falaises pour ajouter les marqueurs sur la carte
        @foreach($crags as $crag)
            var point = L.marker(
                [{{$crag['lat']}},{{$crag['lng']}}],
                {icon: marker_{{$crag['type_voie']}}{{$crag['type_grande_voie']}}{{$crag['type_bloc']}}{{$crag['type_deep_water']}}}
            )
            .bindPopup(
                `
                <img class="photo-couve-site-leaflet" src="/storage/photos/crags/oblyk-home-baume-rousse.jpg" alt="photo de couverture de {{$crag['label']}}">
                <div class="crag-leaflet-info">
                    <h2 class="loved-king-font titre-crag-leaflet">
                        <a href="/site-escalade/{{$crag['id']}}/{{str_slug($crag['label'])}}">{{$crag['label']}}</a>
                    </h2>
                    <table>
                        <tr>
                            <td>Localisation : </td>
                            <td>{{$crag['city']}}, {{$crag['region']}} ({{$crag['code_country']}})</td>
                        </tr>
                        <tr>
                            <td>Type de grimpe : </td>
                            <td class="type-grimpe">
                                @if($crag['type_voie'] == 1)<span class="voie">voie</span>@endif
                                @if($crag['type_grande_voie'] == 1)<span class="grande-voie">grande-voie</span>@endif
                                @if($crag['type_bloc'] == 1)<span class="bloc">bloc</span>@endif
                                @if($crag['type_deep_water'] == 1)<span class="deep-water">deep-water</span>@endif
                            </td>
                        </tr>
                        <tr>
                            <td>Lignes &amp; Cotations : </td>
                            <td>150 lignes, de 5a <i class="material-icons tiny">arrow_forward</i> 6a</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="btn-vers-crags">
                                <a href="/site-escalade/{{$crag['id']}}/{{str_slug($crag['label'])}}" class="waves-effect waves-light btn">voir le site</a>
                            </td>
                        </tr>
                    </table>
                 </div>
                `
            );
            markers.addLayer(point);
        @endforeach

        map.addLayer(markers);

        //passage de la barre de navigation en noir
        let nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>

@endsection
