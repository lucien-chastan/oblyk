<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //1
        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\Crag',
            'content' => '
<p>Se garer sur le petit parking en face de la Chapelle de la Roche.</p>

<p>
(D/A) Continuer le chemin 50 mètres environ jusqu\'au sentier du GR9 avec son balisage Blanc et Rouge.
Au panneau, prendre à droite, direction Col de la Verne, Gîte de Fontlargias, la Lance (Sud).<br>
Suivre la piste pendant presque 1km jusqu\'à un croisement.
</p>

<p>
(1) Quitter celle-ci et prendre à droite (Sud) le GR9, direction Gîte de Fontlargias, La Lance, au pied de la borne qui fournit des explications sur le Rocher des Aures.
</p>

<p>
Dans la descente, à peine arrivé au fond du vallon, quitter le GR et prendre le sentier moins marqué (Est) qui part sur la gauche.
</p>
<p>
(2) Suivre celui-ci à la montée et prendre à droite (Sud, Sud-Ouest) au croisement avec un autre sentier qui est plat pour rejoindre, à 50 mètres environ, le pied de la pointe du Rocher.
</p>
            ',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);


        //2
        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\Topo',
            'content' => '
<p>
Le premier des trois Tomes du topo guide d\'escalade de la Drôme n\'est plus une chimère. Il se nomme "Escalade en Drôme Provençale" il couvre 13 sites pour 950 longueurs.
</p>
<p>
Cet ouvrage a pu sortir de son rêve grâce à une étroite collaboration entre le Conseil Général de la Drôme, le Comité Départemental FFME de la Drôme, les équipeurs et les Clubs gestionnaires des sites.
</p>
            ',
            'user_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //3
        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\Massive',
            'content' => '
<p>
Nouvelle asso qui gère les Barronies : <a href="http://www.grimponies.fr">Grimponies</a> !
</p>
<p>
venez et participez à l\'activité de l\'association
</p> 
            ',
            'user_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);


        //4
        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\User',
            'content' => '
<p>
Salut Lucien, je post sur ton mur !
</p>

<p><cite>Léna</cite></p>
',
            'user_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);


        //5
        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\User',
            'content' => '
<p>        
Je post sur mon mur
</p>
            ',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);


        //6
        DB::table('posts')->insert([
            'postable_id' => 2,
            'postable_type' => 'App\User',
            'content' => '
<p><strong>Salut à tous,</strong></p>

<p>
Vous vous demandez peut-être où en est Oblyk ? Quelles sont les évolutions à venir ? Pourquoi certaines suggestions faites sur le forum ne sont toujours pas en ligne ?  
Oblyk arrive à une nouvelle charnière de sa vie.
</p>

<p>
Je suis sur la fin de ma formation de développeur web, et au vu de toutes les choses que j\'ai apprises depuis septembre, je me rend compte que je ne peux pas continuer à développer Oblyk sur la même base de code …
</p>

<p>
<strong>Du coup, c\'est reparti pour une refonte totale du monstre ! ; )</strong>
</p>

<p>
En deux années d\'existence j\'ai pu voir comment était utilisé Oblyk, voir que certaines sections que je ne pensais pas être très intéressantes étaient la raison de la venue de nombreux nouveaux. Et inversement, j\'ai pu mettre beaucoup d\'énergie dans des sections qui sont restées inutilisées.
</p>

<p>
C\'est donc l\'occasion de recadrer le projet, faire respirer l\'interface et se concentrer sur ce qui fonctionne et vous intéresse :
</p>

<ul>
<li>les infos sur les falaises</li>
<li>le carnet de croix</li>
<li>la recherche de partenaire de grimpe</li>
<li>et du coup implicitement : votre profil et celui des autres</li>
</ul>

<p>
Seront absents, ou du moins, secondaires au début du nouvel Oblyk :
</p>

<ul>
<li>le forum</li>
<li>la partie indoor</li>
</ul>

<p>
Bien sûr, oblyk actuel continuera de fonctionner jusqu’à ce que la nouvelle version soit là, et la transition entre les deux versions sera transparente, rien ne sera perdu.
</p>

<p>
<strong>Et c\'est pour quand ?</strong>
</p>
<p>
Aahhh ! bonne question … et je ne vais pas me risquer à vous donner une date, parce que je n\'ai jamais réussi à estimer et tenir les délais que je me donnais ; )  
Mais dans tous les cas ce n\'est pas pour demain, à la louche nous pourrions parler de septembre 2017 … ah bah voilà, je viens de donner une date ^^.
</p>

<p>
Je vous l\'accord, tous ceci est encore flou et lointain.<br>
Promis, je vous tiendrai au courant dès qu\'il y aura des visuels ou des éléments plus concrets.
</p>

<p>
Merci de tout ce que vous avez déjà fait pour Oblyk !<br>
Comme d\'habitude n\'hésitez pas à me faire part de vos réflexions.
</p>

<p>
Bonne grimpe à vous tous !
</p>
            ',
            'user_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);//6
        DB::table('posts')->insert([
            'postable_id' => 2,
            'postable_type' => 'App\User',
            'content' => '
<p><strong>Salut à tous,</strong></p>

<p>
Vous vous demandez peut-être où en est Oblyk ? Quelles sont les évolutions à venir ? Pourquoi certaines suggestions faites sur le forum ne sont toujours pas en ligne ?  
Oblyk arrive à une nouvelle charnière de sa vie.
</p>

<p>
Je suis sur la fin de ma formation de développeur web, et au vu de toutes les choses que j\'ai apprises depuis septembre, je me rend compte que je ne peux pas continuer à développer Oblyk sur la même base de code …
</p>

<p>
<strong>Du coup, c\'est reparti pour une refonte totale du monstre ! ; )</strong>
</p>

<p>
En deux années d\'existence j\'ai pu voir comment était utilisé Oblyk, voir que certaines sections que je ne pensais pas être très intéressantes étaient la raison de la venue de nombreux nouveaux. Et inversement, j\'ai pu mettre beaucoup d\'énergie dans des sections qui sont restées inutilisées.
</p>

<p>
C\'est donc l\'occasion de recadrer le projet, faire respirer l\'interface et se concentrer sur ce qui fonctionne et vous intéresse :
</p>

<ul>
<li>les infos sur les falaises</li>
<li>le carnet de croix</li>
<li>la recherche de partenaire de grimpe</li>
<li>et du coup implicitement : votre profil et celui des autres</li>
</ul>

<p>
Seront absents, ou du moins, secondaires au début du nouvel Oblyk :
</p>

<ul>
<li>le forum</li>
<li>la partie indoor</li>
</ul>

<p>
Bien sûr, oblyk actuel continuera de fonctionner jusqu’à ce que la nouvelle version soit là, et la transition entre les deux versions sera transparente, rien ne sera perdu.
</p>

<p>
<strong>Et c\'est pour quand ?</strong>
</p>
<p>
Aahhh ! bonne question … et je ne vais pas me risquer à vous donner une date, parce que je n\'ai jamais réussi à estimer et tenir les délais que je me donnais ; )  
Mais dans tous les cas ce n\'est pas pour demain, à la louche nous pourrions parler de septembre 2017 … ah bah voilà, je viens de donner une date ^^.
</p>

<p>
Je vous l\'accord, tous ceci est encore flou et lointain.<br>
Promis, je vous tiendrai au courant dès qu\'il y aura des visuels ou des éléments plus concrets.
</p>

<p>
Merci de tout ce que vous avez déjà fait pour Oblyk !<br>
Comme d\'habitude n\'hésitez pas à me faire part de vos réflexions.
</p>

<p>
Bonne grimpe à vous tous !
</p>
            ',
            'user_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //7
        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\ForumTopic',
            'content' => 'Salut à tous,
<p>
Voici le nouveau forum d\'oblyk !
</p>
<p>
Il est très similaire à l\'ancien, mais il a quand même eu le droit à quelques petites nouveautés ; )
</p>
<ul>
<li>Les posts peuvent être liké (quand on est d\'accord mais qu\'on à pas grand chose à rajouter)</li>
<li>Les posts peuvent être commenté</li>
<li>Ou on peut ajouter un post à la discussions</li>
</ul>
<p>
Autre avantage de ce nouveau forum, il est complètement intégré au fil d\'actualité sur votre profil !
</p>',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}
