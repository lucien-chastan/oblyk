<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User
        $this->call(UsersTableSeeder::class);

        //Photo, vidéo, liens, description
        $this->call(AlbumsTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(DescriptionsTableSeeder::class);
        $this->call(LinksTableSeeder::class);

        //Falaise, secteur, orientation, rocher, etc.
        $this->call(RocksTableSeeder::class);
        $this->call(OrientationsTableSeeder::class);
        $this->call(SeasonsTableSeeder::class);
        $this->call(CragsTableSeeder::class);
        $this->call(ParkingsTableSeeder::class);
        $this->call(RainExposuresTableSeeder::class);
        $this->call(SunsTableSeeder::class);
        $this->call(SectorsTableSeeder::class);

        //Lexique
        $this->call(WordsTableSeeder::class);

        //Ligne et section
        $this->call(ClimbsTableSeeder::class);
        $this->call(AnchorsTableSeeder::class);
        $this->call(PointsTableSeeder::class);
        $this->call(InclinesTableSeeder::class);
        $this->call(ReceptionsTableSeeder::class);
        $this->call(StartsTableSeeder::class);
        $this->call(RoutesTableSeeder::class);
        $this->call(RouteSectionsTableSeeder::class);
        $this->call(GapGradesTableSeeder::class);
        $this->call(TagsTableSeeder::class);

        //Topo
        $this->call(ToposTableSeeder::class);
        $this->call(TopoCragsTableSeeder::class);
        $this->call(TopoSalesTableSeeder::class);
        $this->call(TopoWebsTableSeeder::class);
        $this->call(TopoPdfsTableSeeder::class);

        //Massif
        $this->call(MassivesTableSeeder::class);
        $this->call(MassiveCragsTableSeeder::class);

        //Follow système
        $this->call(FollowsTableSeeder::class);

        //Aide
        $this->call(HelpsTableSeeder::class);

        //Paramètre utilisateur & Lien sociaux
        $this->call(UserSettingsTableSeeder::class);
        $this->call(SocialNetworksTableSeeder::class);
        $this->call(UserSocialNetworksTableSeeder::class);

        //Article
        $this->call(ArticlesTableSeeder::class);

        //Messagerie
        $this->call(ConversationsTableSeeder::class);
        $this->call(UserConversationsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);

        //Fil d'actualité
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);

        //Forum
        $this->call(ForumGeneralCategoriesTableSeeder::class);
        $this->call(ForumCategoriesTableSeeder::class);
        $this->call(ForumTopicsTableSeeder::class);

        //Carnet de croix
        $this->call(TickListsTableSeeder::class);
        $this->call(CrossModesTableSeeder::class);
        $this->call(CrossHardnessesTableSeeder::class);
        $this->call(CrossStatusesTableSeeder::class);
        $this->call(CrossesTableSeeder::class);
        $this->call(CrossSectionsTableSeeder::class);
        $this->call(CrossUsersTableSeeder::class);

        //Recherche de partenaire
        $this->call(UserPlacesTableSeeder::class);
        $this->call(UserPartnerSettingsTableSeeder::class);

        //Salle d'escalade
        $this->call(GymsTableSeeder::class);

        //Table de recherche
        $this->call(SearchesTableSeeder::class);

        // Table news-letter
        $this->call(NewslettersTableSeeder::class);

        // Gym Indoor
        $this->call(RoomsTableSeeder::class);
        $this->call(GymAdministratorsTableSeeder::class);
        $this->call(GymSectorsTableSeeder::class);
        $this->call(GymRoutesTableSeeder::class);

    }
}
