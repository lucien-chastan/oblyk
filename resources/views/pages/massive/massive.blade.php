@extends('layouts.app')
@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/massive.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link href="/css/popupMapStyle.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.massive-parallax', array(
        'imgSrc' => '/img/default-massive-bandeau.jpg',
        'imgAlt' => 'sites escalade ' . $massive->label,
        'nbCrags' => $massive->crags_count,
        'label' => $massive->label,
    ))

    {{--Menu des falaises--}}
    <div class="container topo-menu-zone">
        @include('pages.massive.partials.nav')
    </div>

    {{--contenu de la page--}}
    <div class="container">

        <div id="index">
            @include('pages.massive.tabs.index')
        </div>

        <div id="fil-actu">
            @include('pages.massive.tabs.fil-actu')
        </div>

        <div id="liens">
            @include('pages.massive.tabs.liens')
        </div>

        <div id="sites">
            @include('pages.massive.tabs.sites')
        </div>

    </div>

@endsection

@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/js/mapVariable.js"></script>
    <script src="/js/massive.js"></script>
    <script src="/js/post.js"></script>
    <script>
        convertMarkdownZone();
        initMassiveMap({{$massive->id}});
    </script>
@endsection