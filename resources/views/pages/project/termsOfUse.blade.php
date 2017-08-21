@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_termsOfUse'),
    'meta_description'=>trans('meta/project.description_termsOfUse'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">Conditions d'utilisation</h1>

                <h2 class="titre-2-terms" id="sommaire">SOMMAIRE</h2>

                <ul class="sommaire-mention">
                    <li><a class="lien_mentions_sommaire" href="#article_1">Article 1 : Objet</a></li>
                    <li><a class="lien_mentions_sommaire" href="#article_2">Article 2 : Mentions légales</a></li>
                    <li><a class="lien_mentions_sommaire" href="#article_3">Article 3 : Obligations</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_3_1">3.1 Obligations de l'utilisateur</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_3_2">3.2 Règles principales</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_3_3">3.3 Non respect des conditions générales d'utilisation</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_4">Article 4 : Confidentialité</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_4_1">4.1 Protection des données personnelles</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_4_2">4.2 Droit d'accès aux informations</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_4_3">4.3 Cookies</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_5">Article 5 : Propriété intellectuelle</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_5_1">5.1 Licences de nos contenus</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_5_2">5.2 Violation du droit d'auteur</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_5_3">5.3 Conditions découlant de l'interactivité du site</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_6">Article 6 : Responsabilités</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_6_1">6.1 Dommages matériels et pertes de données</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_6_2">6.2 Responsabilité lors de la pratique</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_7">Article 7 : Limitation de garanties</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_7_1">7.1 Garanties</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_7_2">7.2 Fermeture ou suspension du site</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_8">Article 8 : Liens hypertextes</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_8_1">8.1 Liens vers le site Oblyk.net</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_8_2">8.2 Liens hypertextes en direction de sites tiers</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_9">Article 9 : Droit applicable</a></li>
                </ul>


                <h2 class="titre-2-terms" id="article_1">ARTICLE 1 : OBJET  <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h2>

                <p class="para_mention">
                    Les conditions générales d'utilisation ont pour objet de définir les modalités de mise à disposition des services d'<strong>Oblyk.net</strong> par l'utilisateur. Tout accès et utilisation d'Oblyk.net est soumis au respect de l'ensemble des règles et obligations décrites dans les conditions générales d'utilisation, sans aucune restriction.        </p>

                <p class="para_mention">
                    Toute personne (physique ou morale) souhaitant accéder au service d'<strong>Oblyk.net</strong> doit donc avoir préalablement lu l'intégralité des conditions générales d'utilisation, se trouvant au pied de chaque page du site internet. Il sera donc considéré que par sa seule navigation sur <strong>Oblyk.net</strong>, l'utilisateur a intégralement lu et accepté les conditions générales d'utilisation.        </p>

                <p class="para_mention">
                    <strong>Oblyk.net</strong> se réserve le droit de modifier ou de mettre à jour à tout moment ses conditions générales d'utilisation.        </p>

                <h2 class="titre-2-terms" id="article_2">ARTICLE 2 : MENTIONS LÉGALES <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h2>

                <p class="para_mention">
                    Selon l'article 6 de la loi n°2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé aux utilisateurs d'<strong>Oblyk.net</strong> l'identité des propriétaires du site internet, et de l'organisme hébergeur du site.        </p>

                <p class="para_mention">
                    <strong>Oblyk.net</strong> est édité par Fabio Carmouche et Lucien Chastan. Les directeurs de rédaction d'<strong>Oblyk.net</strong> sont Fabio Carmouche et Lucien Chastan.        </p>

                <p class="para_mention">
                    <strong>Oblyk.net</strong> est hébergé par : GANDI SAS, Société par Actions Simplifiée au capital de 300.000€ ayant son siège social au 63-65 boulevard Masséna à Paris (75013) FRANCE, immatriculée sous le numéro 423 093 459 RCS PARIS, avec le N° TVA FR81423093459. La société GANDI SAS est joignable au +33.(0) 1 70.37.76.61, et à l'adresse <a class="lien_mentions" href="mailto:direction@gandi.net">direction@gandi.net</a>.        </p>

                <p class="para_mention">
                    Le traitement informatique des données sur le site <strong>Oblyk.net</strong> se fait dans le respect de la vie privée et de la légalité : conformément aux dispositions de la loi n° 78-17 du 6 Janvier 1978 relative a l'informatique, aux fichiers et aux libertés, ce site a fait l'objet d'une déclaration auprès de la Commission Nationale de l'Informatique et des Libertés (CNIL) : déclaration n°1890811v0.        </p>

                <h2 class="titre-2-terms" id="article_3">ARTICLE 3 : OBLIGATIONS <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h2>

                <h3 class="h3-mentions" id="article_3_1">3.1 Obligations de l'utilisateur <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    En acceptant les conditions générales d'utilisation d'<strong>Oblyk.net</strong>, l'utilisateur s'interdit de se livrer à des actes de quelque nature que ce soit, tels que l'édition, la mise en ligne, l'émission ou la diffusion de contenus, d'informations et de données qui seraient contraires à la loi, ou qui pourraient porter atteinte à l'ordre public, aux droits d'<strong>Oblyk.net</strong>, ou aux droits de tiers.        </p>

                <h3 class="h3-mentions" id="article_3_2">3.2 Règles principales <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    Par conséquent, l'utilisateur s'engage à respecter les règles suivantes ( liste non-exhaustive ) :        </p>

                <ul>
                    <li>se conformer aux lois en vigueur, respecter les conditions générales d'utilisation, et les droits des tiers</li>
                    <li>ne pas créer, diffuser, transmettre, communiquer ou stocker  des informations et données à caractère diffamatoire, injurieux, obscène, pornographique, pédopornographique, violent ou incitant à la violence, raciste, xénophobe, homophobe, discriminatoire, et plus généralement tout contenu contraire à l'ordre public</li>
                    <li>respecter les droits de propriété intellectuelle liés aux contenus diffusés sur Oblyk.net</li>
                    <li>ne pas détourner une des fonctionnalités d'<strong>Oblyk.net</strong> de son usage normal</li>
                    <li>ne pas diffuser de contenus, de données ou d'informations non conformes à la réalité</li>
                    <li>ne pas diffuser de contenus, de données ou d'informations susceptibles de diminuer, désorganiser ou empêcher l'utilisation normale d'<strong>Oblyk.net</strong>.</li>
                </ul>

                <h3 class="h3-mentions" id="article_3_3">3.3 Non respect des conditions générales d'utilisation <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    Dans le cas ou les conditions générales du site n'auraient pas été respectées, <strong>Oblyk.net</strong> pourra retirer  tout ou partie des contenus mis en ligne par les utilisateurs malveillants. Tout utilisateur a le droit de signaler un contenu qu'il estime contraire aux conditions générales d'utilisation en contactant les administrateurs d'<strong>Obyk.net</strong>.        </p>

                <h2 class="titre-2-terms" id="article_4">ARTICLE 4 : CONFIDENTIALITÉ <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h2>

                <h3 class="h3-mentions" id="article_4_1">4.1 Protection des données personnelles <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    Selon la loi n° 78-87 du 6 janvier 1978, la loi n° 2004-80 du 6 août 2004, l’article L. 226-13 du Code pénal et la Directive 95/46/CE du Parlement européen et du Conseil du 24 octobre 1995, les données personnelles des utilisateurs recueillies lors de leur inscription sont protégées. Elles font l'objet d'un traitement informatique : <strong>Oblyk.net</strong> les utilise uniquement pour que l'utilisateur puisse avoir recours aux différents services et fonctionnalités du site. Ces données peuvent également être utilisée par <strong>Oblyk.net</strong> à des fins statistiques, pour connaître les données de fréquentation du site, ou pour mieux cibler les nouvelles fonctionnalités développées. En aucun cas ces données ne seront transmises à des tiers (particuliers ou partenaires commerciaux) : elles restent en la possession d'<strong>Oblyk.net</strong>, qui en garantit la confidentialité.        </p>

                <h3 class="h3-mentions" id="article_4_2">4.2 Droit d'accès aux informations <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    Conformément aux articles 39 et 40 de la Loi n° 78-17 du 6 janvier 1978, l'utilisateur peut choisir à tout moment d'accéder à ses informations personnelles détenues par <strong>Oblyk.net</strong>, mais aussi demander leur modification ou leur suppression.        </p>

                <h3 class="h3-mentions" id="article_4_3">4.3 Cookies <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    <strong>Oblyk.net</strong> utilise des cookies, qui sont des marqueurs permettant d'améliorer l'expérience de navigation sur le site (sauvegarde de certains paramètres en mémoire sur le navigateur, pour plus de rapidité lors de l'utilisation). Les cookies sont sans dommage pour l'ordinateur et les données personnelles de l'utilisateur.        </p>

                <p class="para_mention">
                    L'utilisateur a le choix d'accepter ou de refuser l'utilisation des cookies sur <strong>Oblyk.net</strong> par le biais de son navigateur internet.        </p>

                <p class="para_mention">
                    Les cookies sont anonymes, et ne sont pas utilisés à des fins de collecte d'information à caractère personnel. Aucune de ces données anonymes ne pourra être transmise à des partenaires commerciaux, ou organismes tiers : elle resteront en possession d'<strong>Oblyk.net</strong>.         </p>

                <h2 class="titre-2-terms" id="article_5">ARTICLE 5 : PROPRIÉTÉ INTELLECTUELLE <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h2>

                <h3 class="h3-mentions" id="article_5_1">5.1 Licences de nos contenus <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    On distingue deux types de contenus sur <strong>Oblyk.net</strong> : le contenu personnel, et le contenu communautaire.        </p>

                <p class="para_mention">
                    Le contenu personnel comprend tout ce que les utilisateurs publient sur leur profil : les voies qu'ils cochent dans leur carnet de croix, leurs informations personnelles, leurs photos personnelles, leurs messages personnels, leurs contributions sur le forum. Ce contenu est soumis au droit d'auteur, et l'auteur est l'utilisateur concerné.        </p>

                <p class="para_mention">
                    Le contenu communautaire comprend les contributions des utilisateurs à <strong>Oblyk.net</strong> : les sites, secteurs et lignes qu'ils ajoutent sur la base de données du site (et les informations détaillées qui y sont liées), les commentaires (publics ou anonymes), les mots ajoutés au lexique, les liens qu'ils postent, les topos qu'ils référencent, les photos qu'ils ajoutent pour la communauté.        </p>

                <p class="para_mention">
                    Le propriétaire du contenu communautaire est ©Oblyk. Ce contenu est sous double licence :             <a class="lien_mentions" href="http://creativecommons.org/licenses/?lang=fr-FR">CC BY-NC-SA</a> (pour le contenu) , et             <a class="lien_mentions" href="http://opendatacommons.org/licenses/odbl/">Open Database License</a> (pour la base de données).        </p>

                <p class="para_mention">
                    Vous êtes libres de remixer, arranger, et adapter notre œuvre à des fins non commerciales, tant que vous créditez notre nom et que les œuvres dérivées que vous diffusez sont soumises aux mêmes conditions. Veuillez créditez ©Oblyk, indiquer le lien du document source sur <a class="lien_mentions" href="http://www.oblyk.net/index.php">www.oblyk.net</a>, et insérer le nom des deux licences (CC BY-NC-SA et Open Database License), ainsi qu'un lien hypertexte vers chacune de ces deux licences.        </p>

                <h3 class="h3-mentions" id="article_5_2">5.2 Violation du droit d'auteur <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    Nous rappelons aux contributeurs d’<strong>Oblyk.net</strong> qu’ils ne doivent jamais ajouter de données provenant de sources protégées par le droit d’auteur (copyright) ou des droits voisins sans autorisation explicite de la part des détenteurs de ces droits.        </p>

                <p class="para_mention">
                    Si vous pensez que des données ont été ajoutées à la base de données d'<strong>Oblyk.net</strong> en violation des droits d’auteur, veuillez nous contacter à <a class="lien_mentions" href="mailto:ekip@oblyk.net">ekip@oblyk.net</a>.        </p>

                <h3 class="h3-mentions" id="article_5_3">5.3 Conditions découlant de l'interactivité du site <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    En ajoutant un contenu (texte, image, ou autre) dans l'une des rubriques interactives du site, l'utilisateur cède expressément et gracieusement à <strong>Oblyk.net</strong> le droit de diffusion de ce contenu (reproduction, représentation, adaptation) par tout moyen (tout support et tout format connu et inconnu à ce jour) pour le monde entier et pour la durée de propriété intellectuelle actuelle ou à venir. Les droits d'auteur restent réservés.        </p>

                <p class="para_mention">
                    <strong>Oblyk.net</strong> se réserve le droit de publier ou non les contributions qu'il reçoit sur le site, de les modifier, les adapter, les traduire en toute langue, les conserver ou les supprimer en ligne à tout moment.        </p>

                <p class="para_mention">
                    L'utilisateur est seul et unique responsable du contenu qu'il ajoute sur <strong>Oblyk.net</strong>. À ce titre, il garantit <strong>Oblyk.net</strong> contre tout recours et/ou action judiciaire qui pourrait découler de sa diffusion. Il répond notamment pénalement et financièrement seul des atteintes éventuelles aux droits de la personne, droit à la vie privée, droit à la dignité humaine et droits d'auteur que causerait sa contribution.        </p>

                <p class="para_mention">
                    Les contributions des utilisateurs n'engagent que leur auteur et ne représentent en aucun cas une prise de position officielle d'<strong>Oblyk.net</strong>.        </p>

                <h2 class="titre-2-terms" id="article_6">ARTICLE 6 : RESPONSABILITÉS <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h2>

                <cite style="color:red">L'utilisation d'Oblyk.net se fait sous l'entière responsabilité des internautes.</cite>

                <h3 class="h3-mentions" id="article_6_1">6.1 Dommages matériels et pertes de données <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    Sous réserve des dispositions légales applicables, <strong>Oblyk.net</strong> ne saurait être tenu responsable de tout dommage direct ou indirect (comme : perte de profits, de clientèle, de données, de biens incorporels ; liste non exhaustive) résultant de l'utilisation ou de l'impossibilité d'utilisation du site, et plus généralement de tout évènement ayant un lien avec le site et/ou tout site tiers. Tout matériel ou contenu téléchargé sur le site <strong>Oblyk.net</strong> l'est aux risques et périls de l'utilisateur. <strong>Oblyk.net</strong> ne saurait être tenu responsable d'éventuels dommages ou pertes de données subis par l'ordinateur d'un utilisateur.        </p>

                <h3 class="h3-mentions" id="article_6_2">6.2 Responsabilité lors de la pratique <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    La pratique des activités sportives de plein air (telles que l'escalade ou d'autres disciplines liées à la montagne) doit se faire avec une connaissance avancée du terrain et des techniques de sécurité de l'activité concernée, et présente l'acceptation d'un degré de risque qui doit être adapté aux capacités de chacun. <strong>Oblyk.net</strong> recommande à ses utilisateurs la plus grande prudence dans l'interprétation des données et informations renseignées par la communauté. <strong>Oblyk.net</strong> ne garantit en aucun cas l'exactitude et l'exhaustivité des indications fournies directement sur ce site (comme l'équipement des lignes, leur hauteur, les conseils présents sur le forum ou dans des commentaires, etc. liste non exhaustive) . Tous ces renseignements son non contractuels et ne peuvent donc pas engager la responsabilité d'<strong>Oblyk.net</strong> ou des auteurs des contenus en question. De plus, ces renseignements ne peuvent se substituer à l'avis d'un professionnel qualifié pour l'activité sportive concernée. <strong>Oblyk.net</strong> décline toute responsabilité liée aux incidents de toute nature pouvant intervenir suite à l'utilisation ou l'interprétation d'informations diffusées sur son site internet.        </p>

                <h2 class="titre-2-terms" id="article_7">ARTICLE 7 : LIMITATION DE GARANTIES <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h2>

                <h3 class="h3-mentions" id="article_7_1">7.1 Garanties <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    Le site est fourni en l'état. Il est accessible en fonction de sa disponibilité, sans aucune garantie expresse ou implicite de la part d'<strong>Oblyk.net</strong>. En particulier, <strong>Oblyk.net</strong> ne garantit pas que :        </p>

                <ul>
                    <li>le site, les contenus ou les produits proposés répondront parfaitement aux attentes des utilisateurs</li>
                    <li>le site fonctionnera de façon ininterrompue et sans erreurs</li>
                    <li>les erreurs seront corrigées</li>
                </ul>

                <h3 class="h3-mentions" id="article_7_2">7.2 Fermeture ou suspension du site <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    <strong>Oblyk.net</strong> se réserve la possibilité, à tout moment, d'interrompre temporairement ou définitivement tout ou partie de ce site internet, sans préavis ni indemnités. <strong>Oblyk.net</strong> ne pourra en aucun cas être tenu responsable des conséquences d'une telle décision.        </p>

                <h2 class="titre-2-terms" id="article_8">ARTICLE 8 : LIENS HYPERTEXTES <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h2>

                <h3 class="h3-mentions" id="article_8_1">8.1 Liens vers le site Oblyk.net <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    Les liens pointant sur n'importe quelle page du site (page d'accueil ou autres) sont autorisés et fortement encouragés. Cependant, <strong>Oblyk.net</strong> n'exerce aucun contrôle sur les sites tiers et ne peut donc assumer aucune responsabilité liée aux contenus, produits, services, informations, matériaux, logiciels des sites externes qui comportent un lien hypertexte vers <strong>Oblyk.net</strong>.        </p>

                <h3 class="h3-mentions" id="article_8_2">8.2 Liens hypertextes en direction de sites tiers <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h3>

                <p class="para_mention">
                    <strong>Oblyk.net</strong> peut contenir des liens hypertexte vers des sites tiers, mais n'exerce aucun contrôle sur ces sites tiers, et donc ne peut assumer aucune responsabilité liée à la disponibilité de ces sites, ou liée aux contenus, publicités, produits, et services disponibles sur ou à partir de ces sites. <strong>Oblyk.net</strong> ne pourra pas être tenu responsable des dommages directs ou indirects liés à l'accès d'un de ses utilisateurs à un site tiers, ou lié à l'utilisation des services proposés sur ces sites.        </p>

                <h2 class="titre-2-terms" id="article_9">ARTICLE 9 : DROIT APPLICABLE <a class="lien-vers-sommaire" href="#sommaire">(sommaire)</a></h2>

                <p class="para_mention">
                    Le site <strong>Oblyk.net</strong> est soumis au droit français
                </p>
            </div>
        </div>
    </div>

@endsection
