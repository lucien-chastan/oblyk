<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'label' => 'La bière est-elle vraiment bonne pour la récupération ?',
            'description' => 'Ah, une bière bien fraîche… Voilà un véritable rituel que beaucoup de grimpeurs ne sacrifieraient pour rien au monde après une bonne journée en falaise ! Au-delà de la sensation de plaisir et de convivialité qu’elle procure, certains ajoutent que la bière serait une excellente boisson pour la récupération. Alors idée reçue ou pas ? La Fabrique Verticale fait le point.',
            'body' => '
La bière est une des boissons les plus consommées au monde. Boisson alcoolisée, elle est obtenue par fermentation, à partir d’eau, de malt (céréale germée, généralement de l’orge mais aussi parfois du froment ou de l’avoine), de houblon et de levure. Cette fermentation produit de l’alcool et du gaz carbonique. En France, on note généralement la bière par son degré d’alcool (2,2° pour les bières dites de table et jusqu’à 5° et plus pour les bières dites de luxe).

![center](https://i0.wp.com/lafabriqueverticale.com/wp-content/uploads/2016/10/biere-cereales-escalade.jpg?w=600)

## Les effets sur la santé

En Grèce antique, Hippocrate utilisait cette boisson, déjà connue, pour faciliter la diurèse et combattre la fièvre. Au Moyen-Âge, elle était réputée pour stimuler l’appétit. Elle remplaçait aussi avantageusement l’eau, souvent contaminée en ce temps. Au XIXe siècle, elle était encore fabriquée et vendue en pharmacie. Et parée de diverses vertus. Oui, mais aujourd’hui ?

## Apports nutritifs de la bière

La teneur en calories d’un verre de bière blonde (33cl) est de 90 à 120kcal. Elle est déterminée par la quantité de sucres fermentés et par l’alcool présent. L’alcool (5° en moyenne pour une blonde) est hypoglycémiant. Il apporte des calories et influence la consommation d’autres substances alimentaires.

Du côté des points positifs, la bière est riche en vitamines B, en raison des levures ajoutées pendant le brassage. On y trouve également des flavonoïdes, en particulier l’apigénine qui aurait des propriétés anti-inflammatoires. Et divers oligo-éléments et minéraux qui ont une influence sur le goût et la densité de la mousse : beaucoup de potassium, du fer, du silicium et du chrome. Attention toutefois, une bière filtrée ou clarifiée perd beaucoup de ses qualités nutritives.

## Bière et récupération

Vient la question décisive : la bière est-elle vraiment utile pour la récupération ? Car c’est un alibi souvent facile pour s’envoyer une bonne petite binch’ après une séance. En fait, pour récupérer après un effort, l’organisme a surtout besoin d’eau, des sels minéraux, de glucides et de protides, et bien sûr de sommeil. Quid de notre petite binouze par rapport à ces différents aspects ?

Du point de vue de la réhydratation, elle a tout faux ! Aïe, ça commence bien… En effet, même si elle contient 90 % d’eau, ce qui explique son caractère rafraîchissant, notre petite mousse est diurétique. Elle aura donc plutôt tendance à accentuer la déshydratation liée à l’effort qu’à compenser les pertes hydriques. Mieux vaut donc boire de l’eau, à plus soif, après une séance d’escalade, qu’une tournée de chopines…

## 1664 raisons de ne pas boire de la bière après l’effort, ou presque

Du point de vue des sels minéraux, des glucides et des protides, là encore : mauvaise nouvelle ! La bière n’en contient pas suffisamment pour qu’il y ait un quelconque effet sur la récupération. De plus, l’alcool qu’elle contient perturbe la régulation de la glycémie, ce qui n’arrange pas les choses. Enfin, sa consommation a un impact néfaste sur la thermorégulation et sur les cycles du sommeil, car c’est un puissant stimulant du système nerveux…

## Vade retro, cerveza

Contrairement aux idées reçues, cette boisson si prisée des grimpeurs s’avère donc plutôt inadaptée pour la récupération. À part bien sûr, le plaisir et les moments de partage qu’elle procure après une bonne journée d’escalade, rien ne plaide en sa faveur. Du moins d’un point de vue strictement scientifique.

Par contre, l’un de ses composés, la levure de bière, est idéal pour bénéficier des bienfaits de la vitamine B, sans les inconvénients cités précédemment… Je vous l’accorde, c’est moins fun. En résumé, rien n’empêche bien sûr de savourer une bonne bière après grimper. Mais avec modération, on est bien d’accord, et en ayant conscience de sa réputation très surfaite en matière de récupération
            ',
            'author' => 'La Fabrique Verticale',
            'file_view' => '',
            'publish' => 1,
            'created_at' => '2016-10-13 12:23:55',
        ]);


        DB::table('articles')->insert([
            'label' => 'OBLYK une plateforme collaborative pour les grimpeurs',
            'description' => 'La toile foisonne de sites communautaires sur l’escalade. Cela va de sites informatifs locaux aux sites de carnets de croix (type 8a.nu) en passant par les sites de partage d’images et ceux de mise en relation.',
            'body' => '
Fabio et Lucien, deux grimpeurs français passionnés viennent de lancer Oblyk, une nouvelle alternative qui se veut plus complète et proche des grimpeurs. 

La TL²B nous livre ses toutes premières impressions sur la version Beta de ce nouveau website qui va tenter d’un coup d’effacer tous les défauts des plateformes existantes !

L’idée c’est d’aller plus loin que le simple référencement des spots de grimpe en allant dans le détail des voies et des blocs en permettant à la communauté de commenter, partager des infos, et accéder aux « classiques » en un coup d’œil. On peut aussi y noter les lignes qu’on a réalisé, et voir sa progression au fil des ans. Ce site devrait aussi permettre de préserver l’intimité des profils des grimpeurs enregistrés et ne se substituera pas aux topos papiers.

Un beau projet, très ambitieux, qui évolue très vite mais qui repose donc sur la capacité des grimpeurs français et étrangers à alimenter la base de données avec la plus grande fiabilité possible.

Un fonctionnement wikipédiste qui rend hélas la tâche plus longue et complexe. Souhaitons donc que cette initiative française rencontre le succès qu’elle mérite, l’interface étant très simple d’utilisation ! 

            ',
            'author' => 'Kairn',
            'file_view' => '',
            'publish' => 1,
            'created_at' => '2015-10-14 10:19:21',
        ]);


        DB::table('articles')->insert([
            'label' => 'Les blocs de la Payre : notre avis sur ce site',
            'description' => 'On a profité du temps quasi estival du week end dernier pour aller user nos chaussons d\'escalade sur les blocs de la Payre, et nous faire une idée sur le potentiel de ce spot de grimpe tout récent (ouvert et développé durant l\'été 2015).',
            'body' => '

Perdu dans un petit vallon en Ardèche, dans le lit de la rivière de la Payre, se trouve ce nouveau site de bloc défriché très récemment par Noé Bernabeu, grimpeur et ouvreur local. Les blocs sont situés à proximité de la falaise de La Payre, connue et équipée depuis de nombreuses années déjà. 

## Noé Bernabeu, l\'artisan du développement de ce site de bloc

Comme nous l\'a expliqué Noé (grenoblois d\'adoption, mais originaire du village de Chomérac, proche du Pouzin), les blocs de la Payre sont restés longtemps méconnus, jusqu\'à cet été, quand il a décidé de s\'armer de sa brosse et de beaucoup de courage pour ouvrir à lui seul la plupart des passages qu\'offre ce site de bloc (environ une soixantaine) ! 

La raison pour laquelle ce site n\'avait pas connu de réel développement jusqu\'à présent ? Elle est simple : bon nombre de blocs sont nichés dans le lit de la rivière, les rendant inaccessibles pendant la majeure partie de l\'année, excepté les mois d\'été ! Mais on vous rassure, on s\'y est rendu ce week-end, et de nombreux blocs restent encore praticables sur les deux rives, même si certains passages classieux ont déjà les pieds dans l\'eau. C\'est donc un spot qui est à privilégier entre la fin du printemps et le début de l\'automne, mais gare aux périodes de crues ! 

## Un site d\'escalade modeste, mais très agréable

Grimpeurs avides de sites majeurs avec une multitude de secteurs et des tonnes de blocs, ravisez-vous : la Payre est un petit site sans prétention, mais qui possède une âme et un charme certains ! Il règne dans le chaos des blocs une atmosphère calme et sereine : vous ne risquez pas de rencontrer ici une foule de grimpeurs se tirant la bourre dans l\'un des derniers projets à la mode. Non, on est plutôt là pour profiter du cadre : écouter le bruit de la rivière et se laisser porter par la beauté des lieux. 

Et la grimpe dans tout ça ? Après tout, c\'est quand même pour ça qu\'on a décidé d\'aller visiter les lieux ! Autant vous dire que si comme nous, vous n\'avez jamais grimpé en bloc sur du calcaire, vous risquez d\'être déboussolés ! Oubliez le grain, l\'adhérence, et tout ce qui crochète. Vous trouverez ici en majorité des prises au formes arrondies et à la texture lisse. Pourtant, au fil des passages, on se prend au jeu, et on se déplace de mieux en mieux sur ces blocs de calcaire de toutes tailles (le site offre des blocs minuscules, tout comme des lignes d\'ampleur en highball). Certaines prises de pieds pour lesquelles on n\'avait aucune confiance à notre arrivée nous paraissent maintenant bien meilleures, et on apprend à optimiser les placements du corps pour compenser le manque d\'adhérence du rocher. Cette escalade si atypique et déboussolante au départ devient réellement addictive, et on en redemande encore. 

## Un site de bloc idéal pour un séjour de courte durée

On vous recommande ce spot si vous cherchez un site de grimpe où passer une journée ou une après-midi : on y trouve au moins une dizaine de blocs dans son niveau. D\'ailleurs certains d\'entre eux nous ont donné du fil à retordre, et on a trouvé que certaines lignes n\'étaient pas évidentes pour la cotation : il faut parfois savoir mettre son amour-propre de côté ! Le site étant « tout neuf », il y a fort à parier que certaines lignes vont être amenées à être re-cotées dans les mois et les années qui viennent, mais peu importe la difficulté, certaines lignes valent vraiment le détour. 

## Un site de bloc original, et plaisant

En bref, les blocs de la Payre, c\'est un site convivial, avec un caillou atypique et une escalade originale qui, sans être la dernière destination à la mode, devrait vous satisfaire complètement pour une journée de grimpe entre amis. Si vous êtes de passage dans la région, on vous recommande chaudement d\'aller y frotter vos chaussons d\'escalade, vous ne serez pas déçus. 

            ',
            'author' => 'Fabio Oblyk',
            'file_view' => '',
            'publish' => 1,
            'created_at' => '2015-10-15 16:30:00',
        ]);

    }
}
