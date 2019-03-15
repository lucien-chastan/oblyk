@extends('layouts.app',[
    'meta_title'=> trans('meta/gym.title', ['label'=>$gym->label, 'big_city'=>$gym->big_city]),
    'meta_description'=>trans('meta/gym.description', ['label'=>$gym->label, 'city'=>$gym->city, 'big_city'=>$gym->big_city]),
    'meta_img'=>'https://oblyk.org' . $gym->bandeau,
    ])

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/gym.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link href="/css/popupMapStyle.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.gym-parallax', array(
        'imgSrc' => $gym->bandeau,
        'logo' => $gym->logo,
        'imgAlt' => 'salle escalade ' . $gym->label,
        'label' => $gym->label,
        'city' => $gym->city,
        'lat' => $gym->lat,
        'lng' => $gym->lng,
        'country' => $gym->country,
        'region' => $gym->region,
        'code_country' => $gym->code_country,
        'gym_type' => $gym->type_voie . $gym->type_grande_voie . $gym->type_bloc . $gym->type_deep_water . $gym->type_via_ferrata
    ))

    {{--Menu des falaises--}}
    <div class="container crag-menu-zone">
        @include('pages.gym.partials.nav')
    </div>

    {{--contenu de la page--}}
    <div class="container info-gym">

        <div id="index">
            @include('pages.gym.tabs.index')
        </div>

        <div id="fil-actu">
            @include('pages.gym.tabs.fil-actu')
        </div>

        @if(Auth::check() && ($is_administrator || config('app.active_indoor')))
            <div id="liste-croix">
                @include('pages.gym.tabs.cross-list')
            </div>
        @endif

        <div id="map">
            @include('pages.gym.tabs.map')
        </div>

    </div>

@endsection

@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/js/mapVariable.js"></script>
    <script src="/js/gym.js"></script>
    <script src="/js/post.js"></script>
    <script src="/js/photo.js"></script>
    <script src="/framework/chartJs/Chart.min.js"></script>
    <script>
        convertMarkdownZone();
    </script>
@endsection