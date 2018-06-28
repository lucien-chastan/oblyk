@extends('layouts.map',[
    'meta_title'=> trans('meta/map.title'),
    'meta_description'=>trans('meta/map.description'),
    'meta_img'=>'https://oblyk.org/img/map_meta.jpg',
    ])

@section('css')
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link rel="stylesheet" href="/framework/leaflet/Control.Geocoder.css">
    <link rel="stylesheet" href="/framework/leaflet/leaflet.draw.css">
    <link href="/framework/leaflet/markercluster.css" rel="stylesheet">
    <link href="/css/popupMapStyle.css" rel="stylesheet">
    <link href="/css/map.css" rel="stylesheet">
@endsection

@section('content')

    {{--contenu de la page--}}
    <div id="map"></div>

    @if(Auth::check())
        <div class="fixed-action-btn btn-add-map">
            <a class="btn-floating btn-large red">
                <i class="large material-icons">add</i>
            </a>
            <ul>
                <li><a onclick="startAdd('sae')" data-position="right" data-delay="50" data-tooltip="@lang('modals/gym.addTooltip')" class="btn-floating purple tooltipped"><i class="material-icons">store_mall_directory</i></a></li>
            </ul>
        </div>
    @endif
@endsection


@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/framework/leaflet/markercluster.js"></script>
    <script src="/framework/leaflet/Control.Geocoder.js"></script>
    <script src="/framework/leaflet/leaflet.draw.js"></script>
    <script src="/framework/leaflet/leaflet.measure.js"></script>
    <script src="/js/mapVariable.js"></script>
    <script src="/js/map.js"></script>
    <script>

        //chargement de la map
        loadMap();

        //boucle sur les salles pour ajouter les marqueurs sur la carte
        @foreach($gyms as $gym)

        var point = L.marker(
            [{{$gym['lat']}},{{$gym['lng']}}],
            {icon: marker_gym_{{$gym['type_boulder']}}{{$gym['type_route']}}}
            )
                .bindPopup(
                    `
                <img class="photo-couve-site-leaflet" src="{{ (file_exists(storage_path('app/public/gyms/200/bandeau-' . $gym['id'] . '.jpg'))) ? '/storage/gyms/200/bandeau-' . $gym['id'] . '.jpg' : '/img/default-gym-bandeau.jpg'}}" alt="photo de couverture de {{$gym['label']}}">
                <div class="crag-leaflet-info">
                    <h2 class="loved-king-font titre-crag-leaflet">
                        <a href="/salle-escalade/{{$gym['id']}}/{{str_slug($gym['label'])}}">{{$gym['label']}}</a>
                    </h2>
                    <table>
                        <tr>
                            <td>Localisation : </td>
                            <td>{{$gym['big_city']}}, {{$gym['region']}} ({{$gym['code_country']}})</td>
                        </tr>
                        <tr>
                            <td>Type de grimpe : </td>
                            <td class="type-grimpe">
                                @if($gym['type_voie'] == 1)<span class="voie">voie</span>@endif
                            @if($gym['type_boulder'] == 1)<span class="bloc">bloc</span>@endif
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="btn-vers-crags">
                            <a href="/salle-escalade/{{$gym['id']}}/{{str_slug($gym['label'])}}" class="waves-effect waves-light btn">voir la salle</a>
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
        var animationScroll = false;
        var nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>

@endsection
