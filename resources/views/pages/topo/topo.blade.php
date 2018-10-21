@extends('layouts.app', [
    'meta_title'=> trans('meta/topo.title', ['label'=>$topo->label]),
    'meta_description'=>trans('meta/topo.description', ['label'=>$topo->label]),
    'meta_img'=>'https://oblyk.org/img/default-topo-bandeau.jpg',
    ])

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/topo.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link href="/css/popupMapStyle.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.topo-parallax', array(
        'imgSrc' => '/img/default-topo-bandeau.jpg',
        'imgAlt' => 'topo escalade ' . $topo->label,
        'label' => $topo->label,
        'author' => $topo->author,
        'editor' => $topo->editor,
        'editionYear' => $topo->editionYear,
    ))

    {{--Menu des falaises--}}
    <div class="container topo-menu-zone">
        @include('pages.topo.partials.nav')
    </div>

    {{--contenu de la page--}}
    <div class="container">

        <div id="index">
            @include('pages.topo.tabs.index')
        </div>

        <div id="fil-actu">
            @include('pages.topo.tabs.fil-actu')
        </div>

        <div id="photos">
            @include('pages.topo.tabs.photos')
        </div>

        <div id="acheter">
            @include('pages.topo.tabs.acheter')
        </div>

        <div id="liens">
            @include('pages.topo.tabs.liens')
        </div>

        <div id="sites">
            @include('pages.topo.tabs.sites')
        </div>

        <div id="map">
            @include('pages.topo.tabs.map')
        </div>

    </div>

@endsection

@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/js/mapVariable.js"></script>
    <script src="/js/topo.js"></script>
    <script src="/js/post.js"></script>
    <script>
        convertMarkdownZone();
    </script>
@endsection