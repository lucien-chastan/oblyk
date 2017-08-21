@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_who'),
    'meta_description'=>trans('meta/project.description_who'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">Qui sommes-nous ?</h1>

                <p>
                    À l'origine du projet, il y a deux grands potes et grimpeurs passionnés : Fabio et Lucien, qui partagent aujourd'hui leur temps entre leur vie lyonnaise et leurs racines drômoises. Bons vivants, déconneurs, mais bosseurs, sérieux et entreprenants quand il faut l'être.
                </p>

                <p>
                    Voilà un rapide aperçu de qui nous sommes, d'où nous venons, et du pourquoi du comment nous avons décidé de créer Oblyk
                </p>

                <h2 class="loved-king-font text-center grey-text text-darken-3">Fabio Carmouche : </h2>

                <img alt="Fabio aux blocs de La Payre" src="/img/site-escalade-bloc-la-payre.jpg" class="img-qui-somme-nous right right-img">
                
                <p>
                    Étant issu d'une famille où la grimpe est loin d'être le sport prédominant, je l'ai découverte sur le tard. Mais ça a été le coup de foudre direct ! (celui que vous voyez dans les films, avec la scène en slow motion, la petite musique de fond, etc.)
                </p>

                <p>
                    Ce que j'ai tout de suite adoré là-dedans, c'est le côté convivial. Ayant fait pas mal d'autres sports avant, je n'avais jamais ressenti autant de proximité et de bonne humeur entre des pratiquants d'une même activité qui parfois ne se connaissent même pas ! Le côté échange, discussion, bref le côté « social » de la grimpe m'attire beaucoup.
                </p>

                <p>
                    Je trouve ce sport très complet, parce qu'il joue autant sur le physique que sur le mental : tout est une question de limites (plus ou moins conscientes), qu'il faut savoir dépasser pour franchir des paliers, ou tout simplement pour se faire plaisir.
                </p>

                <p>
                    Je dois ma découverte à Lucien, qui a eu la très bonne idée de me traîner sur une falaise il y a 5 ans, pour que je teste la grimpe en naturel. Deux voies en moulinette plus tard, le moins que l'on puisse dire, c'est que je ne l'ai jamais regretté !
                    Quel plaisir de pouvoir crier « SEC » à son assureur, et que celui-ci te réponde « OK, JE TE PRENDS BIEN SEC !» ;)
                </p>

                <p>
                    Après avoir passé mes 3-4 premières années à faire principalement de la voie, et de la falaise, je me suis ensuite orienté vers le bloc, qui offre un paquet d'avantages selon moi :
                </p>

                <img alt="Fabio dans le surplomb de la coquille à Franchard Hautes Plaines" src="/img/escalade-bloc-fontainebleau.jpg" class="img-qui-somme-nous left left-img">

                <ul class="oblyk-ul">
                   <li>on se fait une séance à 4 ou 5 potes, où on partage des méthodes, des chutes, on s'encourage dans les pas durs : bref c'est hyper convivial et on se tape des fous rires</li>
                    <li>en extérieur, je peux faire une séance qui s'étale sur une journée entière sans être complètement pété au bout de 3-4 voies dans mon niveau max : j'ai donc l'impression d'en avoir pour mon argent ;)</li>
                    <li>ça demande moins d'investissement en temps et d'acharnement, pour garder un niveau potable, sans forcément avoir régressé dès qu'on baisse le pied pendant une courte période</li>
                    <li>j'ai donc dit « OUI » au Power, et « CIAO » à la Rési/Conti : je suis passé du côté obscur de la FORCE ;)</li>
                </ul>

                <p>
                    J'ai eu la chance de grandir dans la Drôme, une région très agréable, où il fait bon vivre : un climat favorable et de bons spots de grimpe, « what else » ?
                </p>

                <p>
                    Depuis quelques années maintenant, je vis sur Lyon, où on a 2-3 salles dignes de ce nom, mais peu de spots majeurs aux alentours. Heureusement, Fontainebleau n'est qu'à 3h30, ce qui permet d'y aller sur un week-end. Même si la région lyonnaise n'est pas vraiment un haut-lieu de la grimpe, on y trouve quand même un gros vivier de grimpeurs (notamment une belle concentration de machines ;) !
                </p>

                <p>
                    Ayant déjà été utilisateur de plateformes communautaires de grimpe, je n'ai jamais réussi à trouver un outil qui me corresponde tout à fait. Quand Lucien m'a montré www.carnet-de-croix.net, un site qu'il avait développé lui-même, j'ai beaucoup aimé le concept. Je me suis dit qu'en combinant nos efforts, nous pouvions en faire quelque chose de vraiment bien !
                </p>

                <p>
                    Après avoir parlé un peu du concept autour de moi, il est apparu que bon nombre de grimpeurs recherchaient un site communautaire français qui soit moderne, intuitif, et qui permette de faire circuler l'info efficacement dans le monde de la grimpe. D'autant plus qu'actuellement, aucune plateforme communautaire n'a (à ma connaissance) pris le parti de se consacrer à la fois à la grimpe Outdoor et Indoor.
                </p>

                <p>
                    Voilà pourquoi j'ai décidé de me lancer à corps perdu dans ce projet, en septembre 2015. Aujourd'hui, j'espère que nous arriverons à rassembler suffisamment de grimpeurs autour du projet, pour pouvoir le développer à sa juste mesure, parce qu'il en vaut vraiment la peine ! :)
                </p>

                
                <p class="text-center">
                    <img class="responsive-img" src="/img/site-bloc-annot.jpg" alt="Fabio dans le toit du cul du loup (Annot)">
                </p>
                
                <h2 class="loved-king-font text-center grey-text text-darken-3">Lucien Chastan : </h2>

                <img src="/img/escalade-cret-des-roches-pont-de-roide.jpg" alt="Lucien aux Crèt des Roches à Pont de Roide" class="img-qui-somme-nous right right-img">
                <p>
                    L'escalade et moi, c'est une histoire qui remonte déjà pas mal d'années en arrière !
                </p>

                <p>
                    Tout a commencé sur le beau calcaire du Rocher des Aures, dans la Drôme, où j'ai eu la chance de participer aux stages d'été avec François Crespo, quand j'avais 8 ans (quand je vous dis que ça remonte ! ). Pour moi, la grimpe a donc commencé sur du caillou, et pas sur de la résine.
                </p>

                <p>
                    Pendant mes années de collège, j'ai grimpé au club de Taulignan, où j'ai pu « faire mes armes ». C'est à ce moment que j'ai attrapé le virus de la grimpe en naturel, qui m'a poursuivi par la suite… ;)
                </p>

                <p>
                    Dans un deuxième temps, mes études et mes expériences professionnelles m'ont conduit à bouger pas mal :
                </p>

                <ul class="oblyk-ul">
                    <li>d'abord du côté du jura : j'ai pu me frotter aux cotations bien « sèches » de la falaise de Poligny, ça vous forge un homme !</li>
                    <li>
                        puis du côté des Vosges, où j'ai découvert le bloc en extérieur sur un beau grès rose : <br>
                        ça a été une belle expérience, j'ai eu l'occasion de défricher des petits spots peu ou pas connus, avec la bande de potes grimpeurs du coin. Comme on dit par là-bas : « À plus y'a d'grimpeurs, à mieux on rigole ! »
                    </li>
                </ul>

                <p>
                    Si je devais garder une date marquante de ma carrière de grimpeur, ce serait mon premier 7a en falaise, que j'ai enchaîné il y a quelques années à l'Alençon dans la Drôme. Bon, ok, la voie était loin d'être majeure, et faisait 10m de haut… mais toujours est-il que ça a déclenché une belle progression dans ma grimpe par la suite !
                </p>

                <img src="/img/bloc-escalade-pierre-de-laitre-vosges.jpg" alt="Lucien dans une dalle à la Pierre de Laitre (Vosges)" class="img-qui-somme-nous left left-img">

                <p>
                    Même si j'ai commencé ma carrière de grimpeur par de la falaise, aujourd'hui, j'ai obtenu le label « pur bloqueur » : c'est là où je prends le plus de plaisir. Je dirais que le dicton « plus c'est long, plus c'est bon » ne s'applique pas trop dans mon cas ! ;)
                </p>

                <p>
                    Pour moi, la grimpe, c'est un environnement particulier, et une atmosphère très sociale. J'aime échanger avec les autres, et voir sans cesse des nouvelles têtes. Et quand bien sûr tout ça se termine par une petite bière, j'estime être un homme heureux !
                </p>

                <p>
                    Au niveau de ma relation au projet oblyk, il faut savoir que j'ai toujours tenu un carnet de croix : d'abord sur papier, puis sur Excel, puis j'ai cherché petit à petit à perfectionner tout ça. J'ai commencé à apprendre le langage web et la programmation en autodidacte, et j'ai progressé rapidement, avec des réalisations de sites qui étaient de plus en plus sympa.
                </p>

                <p>
                    Bon, aujourd'hui, plus rien à voir avec l'apprenti développeur qui a fait ses premières armes sur des petits sites web « maison », même si j'estime que j'ai toujours matière à apprendre et à m'améliorer.
                </p>

                <p>
                    En tout cas, je me sens vraiment investi dans le projet, et je suis sûr qu'il aboutira. Mon plus grand souhait, c'est de fournir à la communauté un super outil, grâce à l'expérience que j'ai pu engranger en programmation web, et en tant que grimpeur !
                </p>

                {{--<p class="text-center">--}}
                    {{--<img class="responsive-img" src="/img/bloc-froide-fontaine-vosges.jpg" alt="lucien à Froide Fontaine (Vosges)">--}}
                {{--</p>--}}

                <h2 class="loved-king-font text-center grey-text text-darken-3">
                    Et niveau organisation, qui fait quoi ?
                </h2>

                <p>
                    Ce qui nous a beaucoup aidé depuis le lancement du projet, c'est notre complémentarité !
                </p>

                <ul class="oblyk-ul">
                    <li>
                        Lucien, c'est le développeur de l'extrême, celui qui s'occupe de coder, de développer des fonctions, de débugger, de faire les maquettes d'interface, et de résoudre les problèmes techniques.<br>
                        Vous vous l'imaginez sûrement déjà avec des lunettes rondes et un petit air de geek, mais non, c'est quelqu'un de tout à fait normal (enfin presque) ! ;)
                    </li>
                    <li>
                        Fabio, c'est le profil plutôt polyvalent : tantôt communiquant et rédacteur d'articles, tantôt modérateur, tantôt référenceur de spots de grimpe, et tantôt traducteur en anglais des pages du site. Toute la partie administrative beaucoup moins fun, c'est lui aussi (les mentions légales, et le reste).<br>
                        Bref, son truc c'est de switcher d'une tâche à l'autre à la vitesse de l'éclair !
                    </li>
                </ul>

                <p>
                    Nos deux profils bien différents sont un atout pour définir clairement nos responsabilités. Nous ne cherchons jamais à empiéter sur le travail de l'autre : nous prenons toujours soin de nous consulter, et de débattre sur la meilleure solution à adopter dans chaque contexte. Bref, c'est le duo gagnant ! :)
                </p>
            </div>
        </div>
    </div>

@endsection
