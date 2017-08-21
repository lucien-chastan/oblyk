@extends('layouts.map', [
    'meta_title'=> trans('meta/partner.title_map'),
    'meta_description'=>trans('meta/partner.description_map'),
    'meta_img'=>'/img/map_meta.jpg',
    ])

@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

@section('css')
    <link href="/framework/leaflet/leaflet.css" rel="stylesheet">
    <link href="/framework/leaflet/markercluster.css" rel="stylesheet">
    <link href="/css/popupMapStyle.css" rel="stylesheet">
    <link href="/css/map.css" rel="stylesheet">
    <link href="/css/partner-map.css" rel="stylesheet">
@endsection

@section('content')

    {{--contenu de la page--}}
    <div id="map"></div>

    {{--SIDE NAV QUI MONTRE LES GRIMPEURS QUI PARTAGE LA MÊME ZONE--}}
    <div id="my-user-circle-partner" class="side-user-map-partner circle-side">
        <div class="row">
            <div class="col s12">
                @if(Auth::check())

                    @if($user->birth == 0 || $user->birth > date('Y') - 18)

                        @if($user->birth == 0)
                            <p>
                                Bonjour,<br>
                                Avant toute chose pour faire partie de la recheche de partenaire, nous devons connaître ta date de naissance.
                            </p>
                            <form class="submit-form" data-route="{{route('saveUserBirth')}}" onsubmit="submitData(this, refresh); return false">
                                {!! $Inputs::popupError([]) !!}

                                {!! $Inputs::text(['name'=>'birth', 'label'=>'Mon année de naissance', 'value'=>'', 'type'=>'number']) !!}

                                {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

                                <div class="row">
                                    {!! $Inputs::Submit(['label'=>'Enregistrer', 'cancelable' => false]) !!}
                                </div>

                            </form>
                        @else
                            <p>
                                Désolé,<br>
                                Pour des questions de résponsabilité, nous n'autorisons pas les mineurs à utiliser ce service.
                            </p>
                            <p>
                                Grandi encore un peu et reviens dans quelques années !<br>
                                Bonne chance à toi.
                            </p>
                        @endif
                    @else
                        @if($user->partnerSettings->partner == 1)

                            @if($user->places_count > 0)

                                <h2 class="loved-king-font">Qui grimpe au même endroit que moi</h2>

                                <div class="blue-border-zone">
                                    @foreach($places as $place)
                                        <div title="Cliquez pour afficher sur la carte" class="blue-border-div place-div" onclick="zoomOn({{ $place->lat }}, {{ $place->lng }})">
                                            <p class="no-margin text-bold"><i class="material-icons left blue-text">location_on</i> <span class="blue-text" onclick="openProfile({{ $place->user->id }})">{{ $place->user->name }}</span> à {{$place->label}}</p>
                                            <div class="markdownZone grey-text">@markdown($place->description)</div>
                                        </div>
                                    @endforeach
                                </div>


                                @if(count($places) == 0)
                                    <p class="grey-text text-center">
                                        Désolé, il n'y a personne qui partage les mêmes zones de grimpe que toi pour l'instant
                                    </p>
                                @endif

                                <p class="text-right">
                                    <a href="{{ route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)]) }}#mes-lieux" class="btn-flat blue-text"><i class="material-icons left">location_on</i> Voir mes lieux de grimpe</a>
                                </p>
                            @else
                                <h2 class="loved-king-font text-center">Mes lieux de grimpe</h2>

                                <p>
                                    Pour que nous puissions te présenter les grimpeurs autours de chez toi, il faut déjà que tu nous dise où tu grimpe.<br>
                                    Rend-toi dans ton profil et renseigne ta zone de grimpe
                                </p>
                                <p class="text-center">
                                    <a class="btn-flat waves-effect blue-text" href="{{ route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)]) }}#mes-lieux">Mes lieux de grimpe</a>
                                </p>
                            @endif
                        @else

                            <h2 class="loved-king-font text-center">Bienvenue {{ Auth::user()->name }} !</h2>

                            <p>
                                Bienvenue dans la recheche de partenaire d'oblyk ! pour en faire partie il faut que tu passe par 2 étapes.<br>
                                <span class="text-underline">Premièrement</span> : Active la recherche de partenaire et presente toi un peux plus.
                            </p>
                            <p class="text-center">
                                <a class="btn-flat waves-effect blue-text" href="{{ route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)]) }}#partenaire-parametres">Commencer ma recherche</a>
                            </p>
                            <div class="svg-container">
                                @include('pages.home.partials.svg.partenaire_grimpe')
                            </div>
                        @endif
                    @endif
                @else
                    <p class="grey-text text-center">
                        Crée-toi un compte pour avoir accès à liste de grimpeur près de chez toi !<br>
                    </p>
                    <p class="text-center">
                        <a class="btn" href="{{ route('register') }}">Créer un compte</a><br>
                        <a href="{{ route('login') }}">Connexion</a>
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{--SIDE NAV QUI MONTRE UN USTILISATEUR--}}
    <div id="side-user-map-partner" class="side-user-map-partner">
        <div id="content-side-map-partner" class="content-side-map-partner">
            mon contenu
        </div>
        <div id="load-side-map-partner" class="load-side-map-partner">
            <div class="preloader-wrapper active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="btn-mes-lieux" class="fixed-action-btn scale-transition scale-out">
        <a class="btn-floating btn-large red waves-effect" onclick="openVoletMyCircle(true)">
            <i class="large material-icons">filter_tilt_shift</i>
        </a>
    </div>

@endsection


@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/framework/leaflet/markercluster.js"></script>
    <script src="/js/mapVariable.js"></script>
    <script src="/js/partner.js"></script>
    <script>

        //chargement de la map
        loadPartnerMap();
        getPartnerPoints();

        @if(Auth::check() && $user->partnerSettings->partner != 0)
            getMyPlaces();
        @endif

        //passage de la barre de navigation en noir
        let nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>

@endsection
