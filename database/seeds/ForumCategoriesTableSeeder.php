<?php

use Illuminate\Database\Seeder;

class ForumCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 1
        DB::table('forum_categories')->insert([
            'general_category_id' => 1,
            'label' => 'Résumé de trip, histoires',
            'description' => 'Envie de partager une histoire, une anecdote, de faire un retour sur un trip grimpe (photos, vidéos, etc.) ?'
        ]);

        // 2
        DB::table('forum_categories')->insert([
            'general_category_id' => 1,
            'label' => 'Recherche de partenaires',
            'description' => 'Tu cherches quelqu\'un pour grimper dans une salle ou en falaise, ou même pour un trip? C\'est ici !'
        ]);

        // 3
        DB::table('forum_categories')->insert([
            'general_category_id' => 1,
            'label' => 'Zone d\'expression libre',
            'description' => 'Ici, tu peux parler de tout et de rien !'
        ]);

        // 4
        DB::table('forum_categories')->insert([
            'general_category_id' => 1,
            'label' => 'Organiser une sortie grimpe',
            'description' => 'Besoin de trouver un co-voiturage, ou de se faire prêter du matos? Tout ce qui concerne l\'organisation d\'une sortie à plusieurs.'
        ]);

        // 5
        DB::table('forum_categories')->insert([
            'general_category_id' => 1,
            'label' => 'Photos / Vidéos : conseils et matos',
            'description' => 'Pour ceux qui ont besoin de conseils pour prendre de belles images de grimpe, pour choisir le matos, etc.'
        ]);

        // 6
        DB::table('forum_categories')->insert([
            'general_category_id' => 2,
            'label' => 'Boîte à idées',
            'description' => 'Tu as des idées d\'amélioration pour Oblyk, ou des remarques ? C\'est ici que ça se passe !'
        ]);

        // 7
        DB::table('forum_categories')->insert([
            'general_category_id' => 2,
            'label' => 'Bugs',
            'description' => 'Si tu as relevé un bug sur le site, n\'hésite pas à le poster ici. On n\'est pas des machines et on peut faire des erreurs !'
        ]);

        // 8
        DB::table('forum_categories')->insert([
            'general_category_id' => 2,
            'label' => 'Traduction',
            'description' => 'Si tu as remarqué des erreurs sur la traduction anglaise, ou si tu es motivé pour proposer une traduction du site dans une autre langue ! ; )'
        ]);

        // 9
        DB::table('forum_categories')->insert([
            'general_category_id' => 2,
            'label' => 'Articles',
            'description' => 'Lancer une discussion, ou réagir à un article publié sur Oblyk, tout est permis !'
        ]);

        // 10
        DB::table('forum_categories')->insert([
            'general_category_id' => 3,
            'label' => 'Chaussons',
            'description' => 'Voir les avis sur une marque ou un modèle de chaussons, ou partager ses expériences, et ses attentes.'
        ]);

        // 11
        DB::table('forum_categories')->insert([
            'general_category_id' => 3,
            'label' => 'Baudrier, corde, casque',
            'description' => 'Voir les avis sur une marque ou un modèle de baudrier, corde ou casque, et partager ses expériences, et ses attentes.'
        ]);

        // 12
        DB::table('forum_categories')->insert([
            'general_category_id' => 3,
            'label' => 'Quincaillerie : mousquetons, dégaines, etc.',
            'description' => 'Voir les avis sur une marque ou un modèle de mousquetons, dégaines, etc., et partager ses expériences, et ses attentes.'
        ]);

        // 13
        DB::table('forum_categories')->insert([
            'general_category_id' => 4,
            'label' => 'Informations / Réglementation sites d\'escalade',
            'description' => 'Tu cherches des informations sur un site ou la réglementation pour y pratiquer l\'escalade ? C\'est ici que ça se passe.'
        ]);

        // 14
        DB::table('forum_categories')->insert([
            'general_category_id' => 4,
            'label' => 'Voie',
            'description' => 'Tu recherches des informations sur une voie en particulier, ou tu veux partager ton expérience ? C\'est ici que ça se passe !'
        ]);

        // 15
        DB::table('forum_categories')->insert([
            'general_category_id' => 4,
            'label' => 'Grande voie / Trad',
            'description' => 'Ici, tu peux raconter ton expérience dans une grande voie (ou trad), ou demander des informations plus spécifiques. '
        ]);

        // 16
        DB::table('forum_categories')->insert([
            'general_category_id' => 4,
            'label' => 'Résine et salles',
            'description' => 'Tout ce qui concerne les salles d\'escalade.'
        ]);

        // 17
        DB::table('forum_categories')->insert([
            'general_category_id' => 4,
            'label' => 'Club',
            'description' => 'Envie de parler d\'un club en particulier, de promouvoir un évènement organisé par un club, ou même de rechercher des bénévoles ? C\'est par ici !'
        ]);

        // 18
        DB::table('forum_categories')->insert([
            'general_category_id' => 4,
            'label' => 'Bloc',
            'description' => 'Ici, on peut parler de tout ce qui relève de l\'univers du bloc !'
        ]);

        // 19
        DB::table('forum_categories')->insert([
            'general_category_id' => 4,
            'label' => 'Deep water',
            'description' => 'Deep water, psicobloc, bref tout ce qui concerne la grimpe au dessus de l\'eau.'
        ]);

        // 20
        DB::table('forum_categories')->insert([
            'general_category_id' => 4,
            'label' => 'Urban climbing',
            'description' => 'L\'espace dédié à l\'urban climbing ! Là où on peut en faire, les bons spots, etc.'
        ]);

        // 21
        DB::table('forum_categories')->insert([
            'general_category_id' => 5,
            'label' => 'Diététique',
            'description' => 'Ici, tu peux partager tout ce qui concerne la diététique à adopter pour l\'escalade : conseils, recettes, idées, ou questions.'
        ]);

        // 22
        DB::table('forum_categories')->insert([
            'general_category_id' => 5,
            'label' => 'Entraînement spécifique',
            'description' => 'Des conseils ou des questions concernant les exercices spécifiques pour s\'entraîner ? Pan güllich, poutre, etc., c\'est ici que ça se passe. Bref, l\'espace des masos ! ; )'
        ]);

        // 23
        DB::table('forum_categories')->insert([
            'general_category_id' => 5,
            'label' => 'Conseils pour progresser',
            'description' => 'Si tu débutes, ou que tu cherches à progresser en escalade, tu peux poser tes questions ici.'
        ]);

        // 24
        DB::table('forum_categories')->insert([
            'general_category_id' => 5,
            'label' => 'Planification',
            'description' => 'Un espace pour parler de tout ce qui touche, de près ou de loin, à la planification d\'entraînement en escalade.'
        ]);

        // 25
        DB::table('forum_categories')->insert([
            'general_category_id' => 5,
            'label' => 'Blessures',
            'description' => 'Pour partager des expériences sur certaines blessures, et donner des conseils de prévention pour éviter qu\'elle surviennent.'
        ]);

        // 26
        DB::table('forum_categories')->insert([
            'general_category_id' => 6,
            'label' => 'Évènements',
            'description' => 'Pour connaître les prochains évènements qui concernent l\'escalade (compétitions, contests, rassemblements, etc.), ou autre.'
        ]);

        // 27
        DB::table('forum_categories')->insert([
            'general_category_id' => 6,
            'label' => 'Les news de la grimpe',
            'description' => 'Ici, tu peux discuter ou réagir sur les dernières news du monde de la grimpe.'
        ]);

        // 28
        DB::table('forum_categories')->insert([
            'general_category_id' => 7,
            'label' => 'Nouveau topo',
            'description' => 'Si un topo vient de sortir, tu peux en parler ici pour informer les autres grimpeurs qu\'il est disponible.'
        ]);

        // 29
        DB::table('forum_categories')->insert([
            'general_category_id' => 7,
            'label' => 'Recherche de topo',
            'description' => 'Si tu recherches un topo et que tu n\'arrives pas à le trouver, tu peux consulter cette partie du forum.'
        ]);

        // 30
        DB::table('forum_categories')->insert([
            'general_category_id' => 7,
            'label' => 'Discussions topos',
            'description' => 'Un espace de discussion libre où on peut parler de tout ce qui concerne les topos (papier, numérique, etc.).'
        ]);

    }
}
