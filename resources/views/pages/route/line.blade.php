@extends('layouts.app', [
    'meta_title'=> trans('meta/route.title', ['label'=>$route->label]),
    'meta_description'=>trans('meta/route.description', ['label'=>$route->label]),
    'meta_img'=>'/img/default-topo-bandeau.jpg',
    ])

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/line.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.route-parallax', array(
        'imgSrc' => $route->crag->bandeau,
        'imgAlt' => 'voie escalade ' . $route->label,
        'label' => $route->label,
        'crag' => $route->crag,
        'route'=>$route,
        'route_type' => $route->climb_id,
    ))

    {{--Menu des falaises--}}
    <div class="container route-menu-zone">
        @include('pages.route.partials.nav')
    </div>

    {{--contenu de la page--}}
    <div class="container line-zone">

        @include('pages.route.vues.route')

    </div>

@endsection

@section('script')
    <script src="/js/route.js"></script>
    <script>
        convertMarkdownZone();
    </script>
@endsection