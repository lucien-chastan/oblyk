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
                    <p>
                        Oblyk est une grande base de donnée des falaises d'escalades de france et du monde constament enrichie par la communauté,
                        tu peux consulter celle-ci en utilisant le recherche ou en navigant sur la carte
                    </p>
                </div>

                <div class="col s12 m6 l6 center">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.info_falaise')
                    </div>
                    {{--<img src="/img/svg-info-falaise.svg" alt="les informations sur les falaises dans oblyk" class="svg-animation-home">--}}
                </div>
            </div>

            <div class="row">
                <div class="col s12 m6 l6">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.carnet_croix')
                    </div>
                </div>
                <div class="col s12 m6 l6">
                    <h2>Tiens un carnet de croix</h2>
                    <p>Garde une trace de tes sorties ou de ta progression en notant tes croix</p>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m6 l6">
                    <h2>Trouve un partenaire de grimpe</h2>
                    <p>
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

            <div class="row">

                <div class="col s12 m6 l6">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.flux')
                    </div>
                </div>

                <div class="col s12 m6 l6">
                    <h2>Reste au courant</h2>
                    <p>
                        Grâce à son système de flux, oblyk te tiendra au courant de ce qui se passe autour de toi, reçoit les
                        dernières news des falaises, salles, grimpeurs que tu suis
                    </p>
                </div>
            </div>

            <div class="row">

                <div class="col s12 m6 l6">
                    <h2>Rejoins-nous !</h2>
                    <p>
                        Rejoins la communauté d'oblyk et apporte ta pierre à l'édifice
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
                <div class="card">
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
                <div class="card">
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
                <div class="card">
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

        <div class="row">
            <div class="col s12 m4 l4">
                2077 Falaises
            </div>
            <div class="col s12 m4 l4">
                1259 Grimpeurs
            </div>
            <div class="col s12 m4 l4">
                120 Salles
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
    {{--<script type="text/javascript" src="{{url('/')}}/js/home.js"></script>--}}
@endsection