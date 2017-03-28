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
                        tu peux consulter celle-ci en utilisant le recherche ou en navigant sur la carte.
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
                    <p class="explication-oblyk">
                        Bon pour la mémoire, la progression et la motivation, tenir un carnet de croix à beaucoup d'avantage.<br>
                        Oblyk te permet de facilement faire ça, tu pourras ensuite visualiser ta progression grâce à de nombres façon d'analyser et afficher ton carnet de croix
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m6 l6">
                    <h2>Trouve un partenaire de grimpe</h2>
                    <p class="explication-oblyk">
                        Tu arrive dans une nouvelle regions, tu aimerais trouver quelqu'un avec qui grimper en falaise ou en salle ?<br>
                        Regarde du côter de notre carte des grimpeurs, peut-être que tu trouveras quelqu'un avec qui grimper.
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
                        Oblyk intégre un système de flux simple qui te permet d'être au courant de l'activité des falaises autour de chez toi.<br>
                        Par exemple s'il y a une mission "Nettoyage Printanier", l'organisateur post dans le flux de la falaise et hop !
                        tous les intéréssés sont au courant et peuvent venir aider.
                    </p>
                </div>
            </div>

            <div class="row">

                <div class="col s12 m6 l6">
                    <h2>Rejoins-nous !</h2>
                    <p class="explication-oblyk">
                        En rejoingnant oblyk tu auras librement accès à tous les infos de la communauté, te tenir au courant de ce qui se passe dans le
                        monde de la grimpe, tu pourras tenir un carnet de croix pour t'aider à progresser ou pour garder un souvenire de tes passages en falaise.<br>
                        Et tu pouras participer à l'élaboration d'une grande base de connaissance commune des sites d'escalades de France et du monde !
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
                        <span class="card-title">Oblyk 3.0</span>
                    </div>
                    <div class="card-content">
                        <p>
                            Après quelques mois de développement, le voici, Oblyk 3 !!,
                            Avec lui plein d'améliorations arrivent, lisez la suite pour en savoir plus
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
                        <img src="/img/photo-video-forum-escalade-conseil.jpg">
                        <span class="card-title">Oblyk j-3</span>
                    </div>
                    <div class="card-content">
                        <p>
                            On y est presque, les derniers tests sont en cours, très bientôt vous découvrirez
                            à quoi ressemble la nouvelle monture d'oblyk, rdv dans 3 Jours ...
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
                        <img src="/img/evenement-escalade-forum-oblyk.jpg">
                        <span class="card-title">Concours Photo</span>
                    </div>
                    <div class="card-content">
                        <p>
                            Vous n'êtes pas sans savoir qu'une nouvelle version d'oblyk est dans les tuyaux,
                            pour sa sortie nous allons avoir besoin de quelques belles photo
                        </p>
                    </div>
                    <div class="card-action">
                        <a href="#">Lire la suite</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l12 text-right">
                <a>Plus d'actu</a>
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
    <script type="text/javascript" src="/js/home.js"></script>
@endsection