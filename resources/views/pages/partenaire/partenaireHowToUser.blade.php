@extends('layouts.app',[
    'meta_title'=> trans('meta/partner.title_howToUse'),
    'meta_description'=>trans('meta/partner.description_howToUse'),
    'meta_img'=>'/img/map_meta.jpg',
    ])

@section('css')
    <link href="/css/partner-how.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row row-how-partner">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3 titre-1-partner">La recherche de partenaire</h1>
                <h2 class="loved-king-font text-center grey-text text-darken-2 titre-2-partner">Comment ça marche ?</h2>

                <p class="text-center">
                    Tu arrive dans une nouvelle région, tu cherche quelqu'un pour t'accompagner lors de tes sorties falaises ou pour aller grimper à la salle du coin ? Tu trouvera peut-être ton bonheur ici !
                </p>

                @if(!Auth::check())
                    <p class="text-center">
                        Pour voir les grimpeurs inscrits sur la recherche de partenaire, il faut déjà que tu es un compte !<br>
                    </p>
                    <p class="text-center">
                        <a class="btn" href="{{ route('register') }}">Créer un compte</a><br>
                        <a href="{{ route('login') }}">Se connecter</a>
                    </p>
                @endif
            </div>
        </div>


        {{--ÉTAPE 1 : PRÉFÉRENCES--}}
        <div class="row row-how-partner">

            <div class="col s12 m12 l6 div-svg-partner">
                <img src="/img/partner-etape-1.svg" alt="des montagnes et différents représentation de l'escalade">
            </div>

            <div class="col s12 m12 l6">
                <p class="text-underline text-bold">Étape 1 : Mes préférences</p>
                <p>Pour donner envie aux autres de te contacter il faut qu'ils aient un minimum d'informations sur toi, quel style d'escalade tu pratique (bloc, voie, trad, ...), dans quelle cotation tu aime grimper, etc.  </p>
                @if(Auth::check())
                    <p class="text-right">
                        <a class="btn-flat blue-text" href="{{ route('userPage',['user_id'=>Auth::id(), 'user_label'=>str_slug(Auth::user()->name)]) }}#partenaire-parametres"><i class="material-icons left">accessibility</i> Qui je suis ?</a>
                    </p>
                @endif
            </div>
        </div>

        {{--ÉTAPE 2 : MES LIEUX DE GRIMPE--}}
        <div class="row row-how-partner">

            <div class="col s12 m12 l6">
                <p class="text-underline text-bold">Étape 2 : Ma zone de grimpe</p>
                <p>
                    Pour que nous puissions te présenter une liste des grimpeurs près de chez toi, faut-il déjà que nous sachions où tu grimpe !<br>
                    Tu peux établire une liste des lieux où tu grimpe, et oblyk te présentera les grimpeurs qui partage les mêmes zones que toi.
                </p>
                @if(Auth::check())
                    <p class="text-right">
                        <a class="btn-flat blue-text" href="{{ route('userPage',['user_id'=>Auth::id(), 'user_label'=>str_slug(Auth::user()->name)]) }}#mes-lieux"><i class="material-icons left">location_on</i> Mes lieux ?</a>
                    </p>
                @endif
            </div>

            <div class="col s12 m12 l6 div-svg-partner">
                <img src="/img/partner-etape-2.svg" alt="des montagnes avec des marqueurs partout">
            </div>

        </div>

        {{--ÉTAPE 3 : LA CARTE DES GRIMPEURS--}}
        <div class="row row-how-partner">

            <div class="col s12 m12 l6 div-svg-partner">
                <img src="/img/partner-etape-3.svg" alt="zone partagée sur la recherche de partenaire">
            </div>

            <div class="col s12 m12 l6">
                <p class="text-underline text-bold">Étape 3 : La carte des grimpeurs</p>
                <p>Maintenant que tu as renseigné tes lieux d'escalade et dit qui tu étais, tu peux utiliser la carte des grimpeurs pour trouver quelqu'un avec qui tu aimerais grimper.</p>
                <p class="text-right">
                    <a class="btn-flat blue-text" href="{{ route('partnerMapPage') }}"><i class="material-icons left">map</i>La carte des grimpeurs</a>
                </p>
            </div>
        </div>

        {{--ÉTAPE 4 : CONTACT--}}
        <div class="row row-how-partner">

            <div class="col s12 m12 l6">
                <p class="text-underline text-bold">Étape 4 : Contact</p>
                <p>
                    Tu as trouver quelqu'un avec qui tu aimerais grimper ? Envoie lui un message via la messagerie d'oblyk.<br>
                    Libre à vous ensuite de vous organiser comme vous voulez.
                </p>
                @if(Auth::check())
                    <p class="text-right">
                        <a class="btn-flat blue-text" href="{{ route('userPage',['user_id'=>Auth::id(), 'user_label'=>str_slug(Auth::user()->name)]) }}#messagerie"><i class="material-icons left">email</i> Ma messagerie</a>
                    </p>
                @endif
            </div>

            <div class="col s12 m12 l6 div-svg-partner">
                <img src="/img/partner-etape-4.svg" alt="deux grimpeurs se rencontre">
            </div>

        </div>
    </div>

@endsection
