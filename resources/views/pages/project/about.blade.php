@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_about'),
    'meta_description'=>trans('meta/project.description_about'),
    'meta_img'=>'https://oblyk.org/img/meta_home.jpg',
    ])

@section('css')
    <link href="/css/project.css" rel="stylesheet">
@endsection


@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/projects/about.title')</h1>

                <p>@lang('pages/projects/about.para_1')</p>
                <p>
                    @lang('pages/projects/about.para_green_server')
                </p>
                <p class="center">
                    <a href="https://www.phpnet.org/datacenter-vert.php">
                        <img class="img-eco-serveur" src="http://www.phpnet.org/img/logos/logo-phpnet-vert2.png" alt="PHPNET hébergement vert" />
                    </a>
                </p>
                <p>@lang('pages/projects/about.para_2')</p>

                {{--Outil graphique--}}
                <p><strong class="text-underline">@lang('pages/projects/about.title_graphisme')</strong></p>
                <ul>
                    <li><a href="http://inkscape.org/"><img class="logo-outil-about" src="/img/logo_inkscape.svg" alt="logo inkscape"> Inkscape</a> <span class="grey-text">@lang('pages/projects/about.inkscape')</span></li>
                    <li><a href="https://www.gimp.org/"><img class="logo-outil-about" src="/img/logo_gimp.png" alt="logo gimp"> GIMP</a> <span class="grey-text">@lang('pages/projects/about.gimp')</span></li>
                </ul>

                {{--IDE--}}
                <p><strong class="text-underline">@lang('pages/projects/about.title_ide')</strong></p>
                <ul>
                    <li><a href="https://www.jetbrains.com/phpstorm/"><img class="logo-outil-about" src="/img/logo_phpstorm.png" alt="logo phpstorm"> PHPStrom</a> <span class="grey-text">@lang('pages/projects/about.phpstorm')</span></li>
                    <li><a href="https://atom.io/"><img class="logo-outil-about" src="/img/logo_atom.png" alt="logo atom"> Atom</a> <span class="grey-text">@lang('pages/projects/about.atom')</span></li>
                </ul>

                {{--Langage--}}
                <p><strong class="text-underline">@lang('pages/projects/about.title_language')</strong></p>
                <ul>
                    <li>
                        <img class="mini-logo-outil-about" src="/img/logo_php.svg" alt="logo php"> PHP,
                        <img class="mini-logo-outil-about" src="/img/logo_javascript.svg" alt="logo javascript"> JavaScript,
                        <img class="mini-logo-outil-about" src="/img/logo_html.svg" alt="logo html"> HTML,
                        <img class="mini-logo-outil-about" src="/img/logo_css.svg" alt="logo css"> Css <span class="grey-text">@lang('pages/projects/about.basic_language')</span>
                    </li>
                    <li>
                        <img class="mini-logo-outil-about" src="/img/logo_mysql.png" alt="logo MySql"> MySql <span class="grey-text">@lang('pages/projects/about.mysql')</span>
                    </li>
                </ul>

                {{--FrameWork--}}
                <p><strong class="text-underline">@lang('pages/projects/about.title_framework')</strong></p>
                <ul>
                    <li><img class="logo-outil-about" src="/img/logo_laravel.png" alt="logo Laravel"> <a href="https://laravel.com/">Laravel</a> <span class="grey-text">@lang('pages/projects/about.laravel')</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_materialize.png" alt="logo materialize"> <a href="http://materializecss.com/">Materialize</a> <span class="grey-text">@lang('pages/projects/about.materialize')</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_leaflet.png" alt="logo leaflet"> <a href="http://leafletjs.com/">Leaflet</a> <span class="grey-text">@lang('pages/projects/about.leaflet')</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_chartjs.svg" alt="logo chartjs"> <a href="http://www.chartjs.org/">ChartJs</a> <span class="grey-text">@lang('pages/projects/about.chartjs')</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_phototheque.png" alt="logo phototheque"> <a href="http://www.lucien-chastan.fr/phototheque/index.html">Photothèque</a> <span class="grey-text">@lang('pages/projects/about.phototheque')</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_trumbowyg.svg" alt="logo Trumbowyg"> <a href="https://alex-d.github.io/Trumbowyg/">Trumbowyg</a> <span class="grey-text">@lang('pages/projects/about.trumbowyg')</span></li>
                </ul>

                {{--FrameWork--}}
                <p><strong class="text-underline">@lang('pages/projects/about.title_beers')</strong></p>
                <ul>
                    <li><img class="logo-outil-about" src="/img/logo_markus.png" alt="logo markus"> <a href="https://www.markusbiere.com/">Markus</a> <span class="grey-text">@lang('pages/projects/about.markus', ['url'=> route('massivePage',['massive_id'=>1,'massive_label'=>"la-foret-de-saou"])])</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_vieille_mule.svg" alt="logo la vieille mule"> <a href="https://www.lavieillemule.com/">La Vieille Mule</a> <span class="grey-text">@lang('pages/projects/about.vieille_mule')</span></li>
                </ul>

                {{--Outil et API--}}
                <p><strong class="text-underline">@lang('pages/projects/about.title_api')</strong></p>
                <ul>
                    <li><img class="logo-outil-about" src="/img/logo_piwik.png" alt="logo Piwik"> <a href="https://piwik.org/">Piwik</a> <span class="grey-text">@lang('pages/projects/about.piwik')</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_mapbox.png" alt="logo Mapbox"> <a href="https://www.mapbox.com/">Mapbox</a> <span class="grey-text">@lang('pages/projects/about.mapbox')</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_openstreetmap.png" alt="logo OpenStreetMap"> <a href="http://www.openstreetmap.org">OpenStreetMap</a> <span class="grey-text">@lang('pages/projects/about.openstreetmap')</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_gnome.png" alt="logo Gnome"> <a href="https://ubuntugnome.org/">Ubuntu Gnome</a> <span class="grey-text">@lang('pages/projects/about.linux')</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_firefox.png" alt="logo Firefox"> <a href="https://www.mozilla.org/fr/firefox/new/">Firefox</a> <span class="grey-text">@lang('pages/projects/about.firefox')</span></li>
                </ul>
            </div>
        </div>
    </div>

@endsection
