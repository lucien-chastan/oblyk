@extends('layouts.app')

@section('css')
    {{--css particulier à la page--}}
    <link href="/css/home.css" rel="stylesheet">
@endsection

@section('content')

    <div class="parallax-container">
        <div class="parallax">
            <img class="img-parallax-home" src="/img/oblyk-home-baume-rousse.jpg" alt="escalade à la falaise de baume rousse">
            <div class="div-entete-oblyk">
                <h1>Oblyk</h1>
                <p>Site communautaire dédié à l'escalade</p>
            </div>
        </div>
    </div>

    <div class="container description-oblyk">

        <div class="partie-point-home">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h2>Check les infos des falaises</h2>
                    <p class="explication-oblyk">
                        Oblyk est une grande base de donnée des falaises d'escalades de france et du monde constament enrichie par la communauté,
                        tu peux consulter celle-ci en utilisant le recherche ou en navigant sur la carte
                    </p>
                </div>

                <div class="col s12 m6 l6 center">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.info_falaise')
                    </div>
                </div>
            </div>

            <div class="row reverse-smartphone">
                <div class="col s12 m6 l6 order-1">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.carnet_croix')
                    </div>
                </div>
                <div class="col s12 m6 l6 order-2">
                    <h2>Tiens un carnet de croix</h2>
                    <p class="explication-oblyk">Garde une trace de tes sorties ou de ta progression en notant tes croix</p>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m6 l6">
                    <h2>Trouve un partenaire de grimpe</h2>
                    <p class="explication-oblyk">
                        Tu arrive dans une nouvelle regions, tu aimerais trouver quelqu'un avec qui grimper ?
                        Regarde du côter de notre carte des grimpeurs, peut-être que tu trouveras quelqu'un avec qui grimper
                    </p>
                </div>

                <div class="col s12 m6 l6">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.partenaire_grimpe')
                    </div>
                </div>
            </div>

            <div class="row reverse-smartphone">

                <div class="col s12 m6 l6 order-1">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.flux')
                    </div>
                </div>

                <div class="col s12 m6 l6 order-2">
                    <h2>Reste au courant</h2>
                    <p class="explication-oblyk">
                        Grâce à son système de flux, oblyk te tiendra au courant de ce qui se passe autour de toi, reçoit les
                        dernières news des falaises, salles, grimpeurs que tu suis
                    </p>
                </div>
            </div>

            <div class="row">

                <div class="col s12 m6 l6">
                    <h2>Rejoins-nous !</h2>
                    <p class="explication-oblyk">
                        En rejoingnant oblyk tu auras librement accès à tous les infos de la communauté, te tenir au courant de ce qui se passe dans le
                        monde de la grimpe, tu pourras tenir un carnet de croix pour t'aider à progresser ou pour le garde un souvenire de tes passages en falaise.<br>
                        Mais tu pouras aussi participer à l'élaboration d'une grande base de connaissance commune en contribuant au site
                    </p>
                    <p class="center">
                        <a class="waves-effect waves-light btn">Créer un compte</a>
                    </p>
                </div>

                <div class="col s12 m6 l6">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.inscription')
                    </div>
                </div>

            </div>
        </div>


        {{--PARTIE ACTUALITÉ D'OBLYK--}}

        <div class="row">
            <div class="s12 m12 l12">
                <h2 class="center">Quoi de neuf ?</h2>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m12 l4">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="/img/oblyk-home-baume-rousse.jpg">
                        <span class="card-title">Card Title</span>
                    </div>
                    <div class="card-content">
                        <p>
                            I am a very simple card. I am good at containing small bits of information.
                            I am convenient because I require little markup to use effectively.
                        </p>
                    </div>
                    <div class="card-action">
                        <a href="#">Lire la suite</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l4">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="/img/oblyk-home-baume-rousse.jpg">
                        <span class="card-title">Card Title</span>
                    </div>
                    <div class="card-content">
                        <p>
                            I am a very simple card. I am good at containing small bits of information.
                            I am convenient because I require little markup to use effectively.
                        </p>
                    </div>
                    <div class="card-action">
                        <a href="#">Lire la suite</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l4">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="/img/oblyk-home-baume-rousse.jpg">
                        <span class="card-title">Card Title</span>
                    </div>
                    <div class="card-content">
                        <p>
                            I am a very simple card. I am good at containing small bits of information.
                            I am convenient because I require little markup to use effectively.
                        </p>
                    </div>
                    <div class="card-action">
                        <a href="#">Lire la suite</a>
                    </div>
                </div>
            </div>
        </div>

        {{--PARTIE CHIFFRE D'OBLYK--}}
        <div class="row">
            <div class="col s12 m12 l12">
                <h2 class="center">Oblyk en quelques chiffres</h2>
            </div>
        </div>

        <div class="center partie-chiffre-oblyk">
            <div class="row oblyk-number blue-text">
                <div class="col s4 m4 l4">2077<br><span class="loved-king-font">Falaises</span></div>
                <div class="col s4 m4 l4">1259<br><span class="loved-king-font">Grimpeurs</span></div>
                <div class="col s4 m4 l4">120<br><span class="loved-king-font">Salles</span></div>
            </div>

            <div class="row oblyk-number">
                <div class="col s4 m4 l4">71018<br><span class="loved-king-font">Lignes</span></div>
                <div class="col s4 m4 l4">8581<br><span class="loved-king-font">Croix</span></div>
                <div class="col s4 m4 l4">1132<br><span class="loved-king-font">Photos</span></div>
            </div>

            <div class="row oblyk-number">
                <div class="col s4 m4 l4">222<br><span class="loved-king-font">Topos</span></div>
                <div class="col s4 m4 l4">1924<br><span class="loved-king-font">Commentaires</span></div>
                <div class="col s4 m4 l4">105<br><span class="loved-king-font">Vidéos</span></div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    {{--js particulier à la page--}}
    <script>

        $(document).ready(function(){
            $('.parallax').parallax();
        });

    </script>
    <script type="text/javascript" src="/js/home.js"></script>
@endsection