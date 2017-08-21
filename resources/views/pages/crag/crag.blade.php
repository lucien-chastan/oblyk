@extends('layouts.app')

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/crag.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link href="/css/popupMapStyle.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.crag-parallax', array(
        'imgSrc' => $crag->bandeau,
        'imgAlt' => 'falaise escalade ' . $crag->label,
        'label' => $crag->label,
        'city' => $crag->city,
        'country' => $crag->country,
        'region' => $crag->region,
        'code_country' => $crag->code_country,
        'lat' => $crag->lat,
        'lng' => $crag->lng,
        'crag_type' => $crag->type_voie . $crag->type_grande_voie . $crag->type_bloc . $crag->type_deep_water . $crag->type_via_ferrata
    ))

    {{--Menu des falaises--}}
    <div class="container crag-menu-zone">
        @include('pages.crag.partials.nav')
    </div>

    {{--contenu de la page--}}
    <div class="container info-crag">

        <div id="index">
            @include('pages.crag.tabs.index')
        </div>

        <div id="fil-actu">
            @include('pages.crag.tabs.fil-actu')
        </div>

        <div id="voies">
            @include('pages.crag.tabs.voies')
        </div>

        <div id="medias">
            @include('pages.crag.tabs.medias')
        </div>

        <div id="liens">
            @include('pages.crag.tabs.liens')
        </div>

        <div id="topos">
            @include('pages.crag.tabs.topos')
        </div>

        <div id="map">
            @include('pages.crag.tabs.map')
        </div>

    </div>

@endsection

@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/js/mapVariable.js"></script>
    <script src="/js/crag.js"></script>
    <script src="/js/post.js"></script>
    <script src="/js/photo.js"></script>
    <script src="/framework/chartJs/Chart.min.js"></script>
    <script>
        convertMarkdownZone();
        window.addEventListener('load', function () {
            getGraphCrag({{$crag->id}});
        });

        if(typeof document.getElementById('accueilPhototheque') !== "undefined"){
            let accueilVisionneuse = new Phototheque('#accueilPhototheque',
                {
                    "maxHeight" : "150px","gouttiere" : "3px",
                    "lastRow" : "center",
                    "visiotheque" : true,
                    "visiotheque-option" : {
                        "legende" : "data-legende"
                    }
                }
            );
        }

    </script>
@endsection