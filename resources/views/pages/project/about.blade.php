@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_about'),
    'meta_description'=>trans('meta/project.description_about'),
    'meta_img'=>'/img/meta_home.jpg',
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">À propos d'oblyk</h1>

                <p>
                    Oblyk est une platforme communautaire dédiée à l'escalade, elle a pour but de créer une grande base de donnée des falaises et voies de France et du monde, aider les grimpeurs à trouver des partenaires, suivre sa progression en escalade en tenant un carnet de croix, et plus généralement Oblyk est un réseau social de la grimpe.<br>
                    Oblyk est développé par <a href="http://www.lucien-chastan.fr/">Lucien CHASTAN</a>, le code source est ouvert aux  <a href="https://github.com/lucien-chastan/oblyk">contributions</a>.
                </p>

                <p>
                    Voici les quelques les outils &amp; langages utilisés pour le développement d'oblyk :
                </p>

                {{--Outil graphique--}}
                <p><strong class="text-underline">Graphisme :</strong></p>
                <ul>
                    <li><a href="http://inkscape.org/"><img class="logo-outil-about" src="/img/logo_inkscape.svg" alt="logo inkscape"> Inkscape</a> <span class="grey-text">logiciel de dessin vectoriel, utilisé pour les icônes et infographie</span></li>
                    <li><a href="https://www.gimp.org/"><img class="logo-outil-about" src="/img/logo_gimp.png" alt="logo gimp"> GIMP</a> <span class="grey-text">retouche et édition d'image, utilisé pour la retourche et le redimensionnement des images</span></li>
                </ul>

                {{--IDE--}}
                <p><strong class="text-underline">IDE :</strong></p>
                <ul>
                    <li><a href="https://www.jetbrains.com/phpstorm/"><img class="logo-outil-about" src="/img/logo_phpstorm.png" alt="logo phpstorm"> PHPStrom</a> <span class="grey-text">Éditeur PHP, lourd mais puissant, indispensable pour un projet de l'envergure d'Oblyk</span></li>
                    <li><a href="https://atom.io/"><img class="logo-outil-about" src="/img/logo_atom.png" alt="logo atom"> Atom</a> <span class="grey-text">Éditeur de code, léger, pratique pour ouvrir et éditer des petits script rapidement</span></li>
                </ul>

                {{--Langage--}}
                <p><strong class="text-underline">Langage :</strong></p>
                <ul>
                    <li>
                        <img class="mini-logo-outil-about" src="/img/logo_php.svg" alt="logo php"> PHP,
                        <img class="mini-logo-outil-about" src="/img/logo_javascript.svg" alt="logo javascript"> JavaScript,
                        <img class="mini-logo-outil-about" src="/img/logo_html.svg" alt="logo html"> HTML,
                        <img class="mini-logo-outil-about" src="/img/logo_css.svg" alt="logo css"> Css <span class="grey-text">Le quatuor du web </span>
                    </li>
                    <li>
                        <img class="mini-logo-outil-about" src="/img/logo_mysql.png" alt="logo MySql"> MySql <span class="grey-text">Langage de base de donnée</span>
                    </li>
                </ul>

                {{--FrameWork--}}
                <p><strong class="text-underline">FrameWork :</strong></p>
                <ul>
                    <li><img class="logo-outil-about" src="/img/logo_laravel.png" alt="logo Laravel"> <a href="https://laravel.com/">Laravel</a> <span class="grey-text">Framework PHP, puissant et fléxible</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_materialize.png" alt="logo materialize"> <a href="http://materializecss.com/">Materialize</a> <span class="grey-text">Framework Css modérne, responsive et classe</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_leaflet.png" alt="logo leaflet"> <a href="http://leafletjs.com/">Leaflet</a> <span class="grey-text">Framework JavaScript pour l'interaction des cartes</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_chartjs.svg" alt="logo chartjs"> <a href="http://www.chartjs.org/">ChartJs</a> <span class="grey-text">Framework JavaScript pour la création de graphique</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_phototheque.png" alt="logo phototheque"> <a href="http://www.lucien-chastan.fr/phototheque/index.html">Photothèque</a> <span class="grey-text">Framework JavaScript de création des galeries photo</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_trumbowyg.svg" alt="logo Trumbowyg"> <a href="https://alex-d.github.io/Trumbowyg/">Trumbowyg</a> <span class="grey-text">Éditeur de text html (permet de rédiger les posts du fil d'actu)</span></li>
                </ul>

                {{--FrameWork--}}
                <p><strong class="text-underline">Bières préférées :</strong></p>
                <ul>
                    <li><img class="logo-outil-about" src="/img/logo_markus.png" alt="logo markus"> <a href="https://www.markusbiere.com/">Markus</a> <span class="grey-text">Quand tu es dans le jardin de la brasserie et que tu regarde les <a href="{{ route('massivePage',['massive_id'=>1,'massive_label'=>"la-foret-de-saou"]) }}">falaises de Saôu</a> ...</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_vieille_mule.svg" alt="logo la vieille mule"> <a href="https://www.lavieillemule.com/">La Vieille Mule</a> <span class="grey-text">Parce qu'elle est bonne</span></li>
                </ul>

                {{--Outil et API--}}
                <p><strong class="text-underline">Autres outils &amp; API utilisés :</strong></p>
                <ul>
                    <li><img class="logo-outil-about" src="/img/logo_piwik.png" alt="logo Piwik"> <a href="https://piwik.org/">Piwik</a> <span class="grey-text">Outil opensource et autohébergé d'analyse du traffic</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_mapbox.png" alt="logo Mapbox"> <a href="https://www.mapbox.com/">Mapbox</a> <span class="grey-text">Fournisseur des tuiles pour la carte</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_openstreetmap.png" alt="logo OpenStreetMap"> <a href="http://www.openstreetmap.org">OpenStreetMap</a> <span class="grey-text">Fournisseur des datas pour la gérnération des tuiles MapBox</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_gnome.png" alt="logo Gnome"> <a href="https://ubuntugnome.org/">Ubuntu Gnome</a> <span class="grey-text">Mon environement linux préféré, simple, beau stable et rapide</span></li>
                    <li><img class="logo-outil-about" src="/img/logo_firefox.png" alt="logo Firefox"> <a href="https://www.mozilla.org/fr/firefox/new/">Firefox</a> <span class="grey-text">Navigateur web le plus confortable pour le developpement (selon moi ; )</span></li>
                </ul>
            </div>
        </div>
    </div>

@endsection
