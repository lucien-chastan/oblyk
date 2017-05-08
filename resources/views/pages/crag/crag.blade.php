@extends('layouts.app')

@section('css')
    <link href="/css/crag.css" rel="stylesheet">
    <link href="/css/markdown.css" rel="stylesheet">
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link href="/framework/simplemde/simplemde.min.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.crag-parallax', array(
        'imgSrc' => '/img/oblyk-home-baume-rousse.jpg',
        'imgAlt' => 'Falaise de baume rousse',
        'label' => $crag->label,
        'city' => $crag->city,
        'country' => $crag->country,
        'region' => $crag->region,
        'code_country' => $crag->code_country,
        'crag_type' => $crag->type_voie . $crag->type_grande_voie . $crag->type_bloc . $crag->type_deep_water
    ))

    {{--Menu des falaises--}}
    <div class="container crag-menu-zone">
        @include('pages.crag.partials.nav')
    </div>

    {{--contenu de la page--}}
    <div class="container info-crag">
        <div class="row stretchCol">

            <div class="col s12 m7">
                @include('pages.crag.partials.information')
            </div>

            <div class="col s12 m5">
                @include('pages.crag.partials.petiteInformation')
            </div>
        </div>

        <div class="row">
            @include('pages.crag.partials.description')
        </div>

        <div class="row stretchCol">
            @include('pages.crag.partials.topos')
        </div>

        <div class="row">
            @include('pages.crag.partials.photos')
        </div>

        <div class="row stretchCol">
            @include('pages.crag.partials.graph')
        </div>

    </div>

@endsection

@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/js/crag.js"></script>
    <script src="/framework/marked/marked.min.js"></script>
    <script>
        convertMarkdownZone();
    </script>
@endsection