@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_project'),
    'meta_description'=>trans('meta/project.description_project'),
    'meta_img'=>'/img/meta_home.jpg',
    ])

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">Le projet</h1>
                <p>
                    Oblyk, c'est un projet regroupant des acteurs du monde de la grimpe, et qui vise à fournir un outil en perpétuelle évolution, pour améliorer le quotidien de chacun.
                </p>

                <p>
                    Notre passion pour la grimpe nous a amené à développer cet outil communautaire, qui permet de dynamiser la circulation de l'information dans le monde de l'escalade : que ce soit pour des grimpeurs, des équipeurs, mais aussi pour des salles d'escalade, etc.
                </p>

                <p>
                    Concrètement, le concept repose sur une base de données collaborative, que chacun peut enrichir à tout moment grâce à ses expériences personnelles. Nous avons cherché à concevoir une plateforme qui soit simple et intuitive pour :
                </p>

                <ul class="oblyk-ul">
                    <li>dynamiser le partage d'informations (plus la base de données est riche, et plus l'outil devient intéressant à utiliser)</li>
                    <li>rendre plus efficace la recherche d'informations sur un spot d'escalade ou une voie par exemple</li>
                    <li>garder une trace de sa vie de grimpeur (à travers ses réalisations, ses voyages, ses rencontres, etc.)</li>
                </ul>

                <p class="center">
                    <img class="responsive-img" src="/img/amis-grimpeurs-convivialite.jpg" alt="Des bloqueurs qui marchent avec leur crash pad">
                </p>

                <p>
                    Nous avons souhaité inscrire ce projet dans une ambiance et un cadre bien particulier : celui de la convivialité, de la bonne humeur, et des rencontres (l'esprit de la grimpe quoi!). Même si l'outil permet de noter ses réalisations, c'est plus dans une optique personnelle de « souvenir » que dans une logique de compétition entre grimpeurs.
                </p>

                <p>
                    Pour nous, l'escalade doit rester un milieu où la convivialité prime, où l'écologie tient une part importante, et où l'attitude de chacun doit rester compatible avec l'accès libre et collectif aux sites de grimpe.
                </p>

                <p>
                    Dès la création du site, nous avons affirmé notre attachement aux topos papier, qui sont essentiels pour continuer à développer les sites naturels. Étant nous-mêmes de fervents passionnés de topos, nous souhaitons sensibiliser ceux qui soutiennent ce projet à l'importance que revêt l'acte d'achat d'un topo local, pour financer l'entretien d'une falaise chaque année.
                </p>

                <p class="center">
                    <img class="responsive-img" src="/img/topos-escalade.jpg" alt="Des topos entassés">
                </p>

                <h3 class="loved-king-font center">L'histoire du projet</h3>

                <p>
                    Au départ, il y a eu «www.carnet-de-croix.net », un site qui est né d'une volonté : permettre aux grimpeurs de noter leurs croix, et garder une trace de leurs réalisations pendant toutes leurs années de grimpe.
                </p>

                <p>
                    Puis, à l'été 2015, nous avons décidé de donner un nouvel élan au site en nous lançant à corps perdu dans le projet Oblyk ! Après 2 mois de travail intense pour refondre graphiquement l'ancien site et apporter de nouvelles fonctionnalités, on a lancé oblyk.net en septembre. Cette date restera symbolique pour nous. : )
                </p>

                <p>
                    Depuis, le projet a évolué, et on souhaite maintenant se consacrer à de multiples actions dans le monde de la grimpe : promouvoir des évènements sur des falaises, permettre aux salles de communiquer avec leurs grimpeurs grâce aux outils qu'on met à leur disposition, mais aussi permettre à tous d'accéder facilement à une information de qualité, mise à disposition par les utilisateurs.
                </p>

                <p>
                    Oblyk, c'est un projet sur le long terme, ancré dans l'avenir, et qui va évoluer constamment pour répondre le mieux possible aux attentes de tous les grimpeurs, en ajoutant de nouveaux outils très régulièrement. (appli smartphone dans quelques temps ? etc.)
                </p>

                <h3 class="loved-king-font center">Oblyk, comment ça marche, qui en fait partie ? </h3>

                <p>
                    Concrètement, tout le monde peut faire partie du projet, à partir du moment où l'on se reconnaît dans nos valeurs. Ce projet peut exister uniquement si nous sommes nombreux à le porter : c'est autant le notre que le votre, à partir du moment où vous y adhérez et y participez !
                </p>

                <p>
                    Notre objectif, c'est de faire circuler l'information plus facilement dans le monde de la grimpe (pour les sites naturels et les SAE). Pour y parvenir, il faut qu'un maximum de grimpeurs jouent le jeu. Par exemple, en « suivant » une falaise sur oblyk, on reçoit ses dernières actualités directement sur son profil : on est ainsi informé très rapidement en fonction de ses centres d'intérêt.
                </p>

                <p>
                    Nous espérons pouvoir réaliser cet objectif (ambitieux?) avec l'aide de tous, en devenant acteurs de l'information dans la communauté, dès lors qu'on se sent impliqué pour le faire.
                </p>

                <p class="center">
                    <img class="responsive-img" src="/img/groupe-convivialite-escalade.jpg" alt="Des grimpeurs qui jouent au Tarot">
                </p>

                <h3 class="loved-king-font center">Bref, Oblyk, c'est une belle bande de potes</h3>
                <p>
                    Nous sommes persuadés que ce projet peut amener de très belles choses, et qu'il a un vrai potentiel d'évolution.
                </p>

                <p>
                    Nous serons ravis de pouvoir vous compter parmi cette grande famille : plus nous seront nombreux à soutenir le projet, et plus grandes seront les chances de réaliser ses objectifs.
                </p>

                <p>
                    Qui sait où oblyk en sera dans 2, 3 ou 5 ans ? Mais ce qui est sûr c'est qu'on va se donner à fond
                </p>

                <p>
                    Nous sommes juste les « artisans » de cet outil, mais c'est le dynamisme de la communauté qui sera la clé de sa réussite. :)
                </p>
            </div>
        </div>
    </div>

@endsection
