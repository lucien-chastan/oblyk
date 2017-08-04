@extends('layouts.map')

@section('css')
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
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
                <li><a onclick="startAdd('sae')" data-position="right" data-delay="50" data-tooltip="Ajouter une salle" class="btn-floating purple tooltipped"><i class="material-icons">store_mall_directory</i></a></li>
                <li><a onclick="startAdd('crag')" data-position="right" data-delay="50" data-tooltip="Ajouter un site" class="btn-floating blue tooltipped" class="btn-floating blue"><i class="material-icons">terrain</i></a></li>
            </ul>
        </div>
    @endif
@endsection


@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/framework/leaflet/markercluster.js"></script>
    <script src="/js/mapVariable.js"></script>
    <script src="/js/map.js"></script>
    <script>

        //chargement de la map
        loadMap();

        //boucle sur les falaises pour ajouter les marqueurs sur la carte
        @foreach($crags as $crag)

            var point = L.marker(
                [{{$crag['lat']}},{{$crag['lng']}}],
                {icon: marker_{{$crag['type_voie']}}{{$crag['type_grande_voie']}}{{$crag['type_bloc']}}{{$crag['type_deep_water']}}{{$crag['type_via_ferrata']}}}
            )
            .bindPopup(
                `
                <img class="photo-couve-site-leaflet" src="{{str_replace('/crags/1300/', '/crags/200/', $crag['bandeau'])}}" alt="photo de couverture de {{$crag['label']}}">
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
                            <td>
                                {{$crag['routes_count']}} lignes
                                @if($crag['routes_count'] > 0 ), de <strong class="text-bold color-grade-{{$crag->gapGrade->min_grade_val}}">{{$crag->gapGrade->min_grade_text}}</strong> <i class="material-icons tiny">arrow_forward</i> <strong class="text-bold color-grade-{{$crag->gapGrade->max_grade_val}}">{{$crag->gapGrade->max_grade_text}}</strong> @endif
                            </td>
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

        //boucle sur les falaises pour ajouter les marqueurs sur la carte
        @foreach($gyms as $gym)

        var point = L.marker(
            [{{$gym['lat']}},{{$gym['lng']}}],
            {icon: marker_gym_{{$gym['type_boulder']}}{{$gym['type_route']}}}
            )
                .bindPopup(
                    `
                <img class="photo-couve-site-leaflet" src="/img/default-gym-bandeau.jpg" alt="photo de couverture de {{$gym['label']}}">
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
        let nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>

@endsection
