<?php

namespace App\Http\Controllers\Vue;

use App\Album;
use App\Article;
use App\Conversation;
use App\Crag;
use App\Cross;
use App\Description;
use App\Follow;
use App\ForumTopic;
use App\Notification;
use App\Photo;
use App\Post;
use App\Route;
use App\TickList;
use App\Topo;
use App\User;
use App\UserConversation;
use App\Video;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserVueController extends Controller
{


    //VUE : LES SUIVIS
    function vueFollow($user_id){

        if(Auth::id() == $user_id){

            $user = User::where('id',$user_id)->with('follows.followed')->first();

            $follows = [];

            foreach ($user->follows as $follow){

                if($follow->followed_type != 'App\User' && $follow->followed_type != 'App\Topo'){

                    $catTitre = '';

                    //FALAISE
                    if($follow->followed_type == 'App\Crag'){
                        $follow->followUrl = route('cragPage', ['crag_id'=>$follow->followed_id, 'crag_label'=>str_slug($follow->followed->label)]);
                        $follow->followName = $follow->followed->label;
                        $follow->followIcon = ($follow->followed->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $follow->followed->bandeau);
                        $follow->followInformation = $follow->followed->region . ', ' . ($follow->followed->code_country);
                        $catTitre = 'sites';
                    }

                    //MASSIF
                    if($follow->followed_type == 'App\Massive'){
                        $follow->followUrl = route('massivePage', ['massive_id'=>$follow->followed_id, 'massive_label'=>str_slug($follow->followed->label)]);
                        $follow->followName = $follow->followed->label;
                        $follow->followIcon = '/img/icon-search-massive.svg';
                        $follow->followInformation = 'regroupement de site';
                        $catTitre = 'regroupements';
                    }

                    //FORUM
                    if($follow->followed_type == 'App\ForumTopic'){
                        $follow->followUrl = route('topicPage', ['topic_id'=>$follow->followed_id, 'topic_label'=>str_slug($follow->followed->label)]);
                        $follow->followName = $follow->followed->label;
                        $follow->followIcon = '/img/forum-' . $follow->followed->category_id . '.svg';
                        $follow->followInformation = 'sujet sur le forum';
                        $catTitre = 'topics';
                    }

                    $follows[$catTitre][] = $follow;
                }
            }

            $data = [
                'user' => $user,
                'follows' => $follows
            ];

            return view('pages.profile.vues.followVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    //VUE : LA TOPOTHÈQUE
    function vueTopotheque($user_id){

        $user = User::where('id',$user_id)->with('follows.followed')->with('settings')->first();
        $relationStatus = Follow::statusRelation(Auth::id(),$user_id);

        if($relationStatus == 3 || $user->settings->public == 1 || $user->id == Auth::id()){

            $topos = [];

            foreach ($user->follows as $follow){
                if($follow->followed_type == 'App\Topo'){
                    $follow->followUrl = route('topoPage', ['topo_id'=>$follow->followed_id, 'topo_label'=>str_slug($follow->followed->label)]);
                    $follow->followName = $follow->followed->label;
                    $follow->followIcon = (file_exists(storage_path('app/public/topos/200/topo-' . $follow->followed->id . '.jpg'))) ? '/storage/topos/200/topo-' . $follow->followed->id . '.jpg' : '/img/default-topo-couverture.svg';
                    $follow->followInformation = $follow->followed->editor . ', ' . $follow->followed->editionYear;
                    $topos[] = $follow;
                }
            }

            $data = [
                'user' => $user,
                'topos' => $topos
            ];

            return view('pages.profile.vues.topothequeVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }

    }


    //VUE : LES AMIS
    function vueFriend($user_id){

        $user = User::where('id',$user_id)->with('follows.followed')->with('settings')->first();
        $relationStatus = Follow::statusRelation(Auth::id(),$user_id);

        if($relationStatus == 3 || $user->settings->public == 1 || $user->id == Auth::id()){

            $friends = [];

            foreach ($user->follows as $follow){
                if($follow->followed_type == 'App\User'){

                    $genre = '';
                    if($follow->followed->sex == 0) $genre = 'Inféfini';
                    if($follow->followed->sex == 1) $genre = 'Femme';
                    if($follow->followed->sex == 2) $genre = 'Homme';

                    $age = $follow->followed->birth != 0 ? date('Y') - $follow->followed->birth : '?';

                    $image = file_exists(storage_path('app/public/users/100/user-' . $follow->followed->id . '.jpg')) ? '/storage/users/100/user-' . $follow->followed->id . '.jpg' : '/img/icon-search-user.svg';

                    $follow->followUrl = route('userPage', ['user_id'=>$follow->followed_id, 'user_label'=>str_slug($follow->followed->name)]);
                    $follow->followName = $follow->followed->name;
                    $follow->followIcon = $image;
                    $follow->followInformation = $genre . ', ' . $age . ' ans';
                    $friends[] = $follow;
                }
            }

            $data = [
                'user' => $user,
                'friends' => $friends
            ];

            return view('pages.profile.vues.friendVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }

    //VUE : LE DASHBOARD
    function vueDashboard($user_id){

        if(Auth::id() == $user_id){

            $user = User::where('id',$user_id)->with('settings')->first();

            $data = ['user' => $user,];
            return view('pages.profile.vues.dashboardVue', $data);

        }else{
            return view('pages.profile.vues.noRight');
        }
    }


    //VUE : A PROPOS
    function vueAPropos($user_id){

        $user = User::where('id',$user_id)
            ->with('settings')
            ->with('socialNetworks')
            ->with('socialNetworks.socialNetwork')
            ->withCount('crags')
            ->withCount('routes')
            ->withCount('descriptions')
            ->withCount('photos')
            ->withCount('videos')
            ->withCount('topos')
            ->withCount('topoWebs')
            ->withCount('topoPdfs')
            ->withCount('posts')
            ->first();

        $user->sommeAdd = $user->crags_count + $user->routes_count + $user->descriptions_count + $user->photos_count + $user->videos_count + $user->topos_count + $user->topoWebs_count + $user->topoPdfs_count + $user->posts_count;

        //On va chercher si l'auth est amis avec l'user
        $relationStatus = Follow::statusRelation(Auth::id(),$user_id);

        if($user->sex == 0) $user->genre = 'Inféfini';
        if($user->sex == 1) $user->genre = 'Femme';
        if($user->sex == 2) $user->genre = 'Homme';

        $user->age = $user->birth != 0 ? date('Y') - $user->birth : '?';

        $user->image = file_exists(storage_path('app/public/users/200/user-' . $user->id . '.jpg')) ? '/storage/users/200/user-' . $user->id . '.jpg' : '/img/icon-search-user.svg';
        $user->bandeau = file_exists(storage_path('app/public/users/1300/bandeau-' . $user->id . '.jpg')) ? '/storage/users/1300/bandeau-' . $user->id . '.jpg' : '';

        $data = [
            'user' => $user,
            'relationStatus' => $relationStatus
        ];
        return view('pages.profile.vues.aProposVue', $data);

    }


    //VUE : FIL D'ACTUALITÉ
    function vueFilActu($user_id){

        $user = User::where('id', $user_id)->with('settings')->first();
        $relationStatus = Follow::statusRelation(Auth::id(),$user_id);

        if($relationStatus == 3 || $user->settings->public == 1 || $user->id == Auth::id()){

            $data = ['user' => $user];

            return view('pages.profile.vues.filActuVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }


    }


    //VUE : LES ALBUMS
    function vueAlbums($user_id){

        $user = User::where('id',$user_id)->with('albums')->with('albums.photos')->with('settings')->first();
        $relationStatus = Follow::statusRelation(Auth::id(),$user_id);

        if($relationStatus == 3 || $user->settings->public == 1 || $user->id == Auth::id()){

            $data = ['user' => $user,];
            return view('pages.profile.vues.albumsVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    //VUE : LES PHOTOS
    function vuePhotos($user_id, $album_id){

        $user = User::where('id',$user_id)->with('albums')->with('albums.photos')->with('settings')->first();
        $relationStatus = Follow::statusRelation(Auth::id(),$user_id);

        if($relationStatus == 3 || $user->settings->public == 1 || $user->id == Auth::id()){

            $album = Album::where('id',$album_id)->with('photos')->first();
            $data = [
                'user' => $user,
                'album' => $album
            ];

            return view('pages.profile.vues.photosVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    // VUE : LES VIDÉOS
    function vueVideos($user_id){

        $user = User::where('id',$user_id)->with('videos')->with('videos.viewable')->with('settings')->first();
        $relationStatus = Follow::statusRelation(Auth::id(),$user_id);

        if($relationStatus == 3 || $user->settings->public == 1 || $user->id == Auth::id()){

            $data = ['user' => $user,];
            return view('pages.profile.vues.videosVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    //VUE : LES CROIX
    function vueCroix($user_id){

        $user = User::where('id',$user_id)->with('settings')->first();
        $relationStatus = Follow::statusRelation(Auth::id(),$user_id);

        if($relationStatus == 3 || $user->settings->public == 1 || $user->id == Auth::id()){

            $crosses = Cross::where('user_id', $user->id)
                ->with('crossSections')
                ->with('crossStatus')
                ->with('crossSections.routeSection')
                ->with('route.crag')
                ->with('route.routeSections')
                ->get();

            $crags = $pays = $regions = $years = $crossSectionIds = [];
            $somme_metre = 0;
            $max_val = 0;
            $max_grade = '';
            $max_sub_grade = '';

            //on fait un tableau des longueurs faites
            foreach ($crosses as $cross ) {
                foreach ($cross->crossSections as $section) $crossSectionIds[] = $section->route_section_id;
            }


            //Rangement des croix dans différent tableaux (pour le trie ensuite
            foreach ($crosses as $cross){
                $crags[$cross->route->crag->id][] = $cross;
                $pays[$cross->route->crag->code_country][] = $cross;
                $regions[$cross->route->crag->region][] = $cross;
                $years[$cross->release_at->format('Y')][] = $cross;
                $somme_metre += $cross->route->height;

                //on va cherche la cotation max
                if($cross->status_id != 1){
                    foreach ($cross->route->routeSections as $section){
                        if(in_array($section->id, $crossSectionIds)){
                            if ($section->grade_val > $max_val) {
                                $max_val = $section->grade_val;
                                $max_grade = $section->grade;
                                $max_sub_grade = $section->sub_grade;
                            }
                        }
                    }
                }
            }


            $data = [
                'user' => $user,
                'crags' => $crags,
                'pays' => $pays,
                'regions' => $regions,
                'years' => $years,
                'metres' => $somme_metre,
                'max_val' => $max_val,
                'max_grade' => $max_grade,
                'max_sub_grade' => $max_sub_grade,
                'crosses' => $crosses,
            ];
            return view('pages.profile.vues.croixVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    //VUE : LA TICK LIST
    function vueTickList($user_id){

        if(Auth::id() == $user_id){

            $tickLists = TickList::where('user_id',$user_id)->with('route.crag')->with('route.routeSections')->get();

            $crags = [];

            foreach ($tickLists as $ticks){
                $crags[$ticks->route->crag_id][] = $ticks;
            }

            $data = [
                'crags' => $crags
            ];

            return view('pages.profile.vues.tickListVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    //VUE : PROJET
    function vueProjet($user_id){

        if(Auth::id() == $user_id){

            $user = User::where('id',Auth::id())->first();
            $data = ['user' => $user,];
            return view('pages.profile.vues.projetVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    //VUE ANALYTIKS
    function vueAnalytiks($user_id){

        if(Auth::id() == $user_id){

            $user = User::where('id',Auth::id())->first();
            $data = ['user' => $user,];
            return view('pages.profile.vues.analytiksVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }

    }


    //VUE : MESSAGERIE
    function vueMessagerie($user_id){

        if(Auth::id() == $user_id){

            $user = User::where('id',Auth::id())->first();
            $data = ['user' => $user];
            return view('pages.profile.vues.messagesVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    //VUE : RECHERCHE DE PARTENAIRE : LES LIEUX
    function vueLieux($user_id){

        if(Auth::id() == $user_id){

            $user = User::where('id',Auth::id())->first();
            $data = ['user' => $user,];
            return view('pages.profile.vues.lieuxVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    //VUE : RECHERCHE DE PARTENAIRE : QUI JE SUIS
    function vuePartenaireParametres($user_id){

        if(Auth::id() == $user_id){

            $user = User::where('id',Auth::id())->first();
            $data = ['user' => $user,];
            return view('pages.profile.vues.partenaireParametresVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    //VUE : LES NOTIFICATIONS
    function vueNotifications($user_id){

        if(Auth::id() == $user_id){

            $user = User::where('id',Auth::id())->first();
            $findNotifications = Notification::where('user_id',$user->id)->orderBy('read')->orderBy('created_at', 'desc')->get();

            $notifications = [];
            foreach ($findNotifications as $notification){
                $notification->data = json_decode($notification->data);
                $notification->background = ($notification->read == 0) ? 'new-notification' : '';
                $notifications[] = $notification;
            }

            $data = [
                'user' => $user,
                'notifications' => $notifications
            ];

            return view('pages.profile.vues.notificationsVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }
    }


    //VUE : PARAMETRES
    function vueSettings($user_id){

        if(Auth::id() == $user_id){

            $user = User::where('id',Auth::id())->with('settings')->with('socialNetworks.socialNetwork')->first();

            $user->image = file_exists(storage_path('app/public/users/100/user-' . $user->id . '.jpg')) ? '/storage/users/100/user-' . $user->id . '.jpg' : '/img/icon-search-user.svg';
            $user->bandeau = file_exists(storage_path('app/public/users/1300/bandeau-' . $user->id . '.jpg')) ? '/storage/users/1300/bandeau-' . $user->id . '.jpg?cache=' . date('Ymdhis') : '';

            $data = ['user' => $user,];
            return view('pages.profile.vues.settingsVue', $data);

        }else{

            return view('pages.profile.vues.noRight');

        }

    }



    //**************************

    //LES SOUS VUES DU DASHBOARD

    //**************************


    // BOX : BIENVENUE
    function subVueWelcome($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.welcome', $data);
    }


    // BOX : LES CROIX DES POTES
    function subVueCroixPote($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.croixPote', $data);
    }

    // BOX : MES CROIX À MOI
    function subVueMesCroix($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.mesCroix', $data);
    }

    // BOX : LES DERNIERS SUJET DU FORUM
    function subVueForumLast($user_id){
        $user = User::where('id',$user_id)->first();
        $topics = ForumTopic::where('nb_post','>',0)->orWhere('user_id',$user->id)->with('category')->with('user')->orderBy('last_post', 'desc')->skip(0)->take(10)->get();
        $data = [
            'user' => $user,
            'topics' => $topics,
        ];
        return view('pages.profile.vues.dashboardBox.boxVues.forum-last', $data);
    }

    // BOX : MES CONTRIBUTIONS
    function subVueContribution($user_id){

        $user = User::where('id',$user_id)
            ->withCount('crags')
            ->withCount('routes')
            ->withCount('descriptions')
            ->withCount('photos')
            ->withCount('videos')
            ->withCount('topos')
            ->withCount('topoWebs')
            ->withCount('topoPdfs')
            ->withCount('posts')
            ->first();

        $sommeAdd = $user->crags_count + $user->routes_count + $user->descriptions_count + $user->photos_count + $user->videos_count + $user->topos_count + $user->topoWebs_count + $user->topoPdfs_count + $user->posts_count;

        $data = [
            'user' => $user,
            'somme' => $sommeAdd
        ];
        return view('pages.profile.vues.dashboardBox.boxVues.contribution', $data);
    }


    // BOX : LES DERNIÈRES NEWS
    function subVueNewsOblyk($user_id){
        $user = User::where('id',$user_id)->first();
        $articles = Article::where([['id','>','0'],['publish','=',1]])->withCount('descriptions')->orderBy('created_at','desc')->skip(0)->take(3)->get();

        $data = [
            'user' => $user,
            'articles' => $articles,
        ];

        return view('pages.profile.vues.dashboardBox.boxVues.news-oblyk', $data);
    }

    // BOX : LES DERNIÈRES PHOTOS
    function subVuephotosLast($user_id){
        $user = User::where('id',$user_id)->first();
        $photos = Photo::where('illustrable_type', 'App\User')
            ->with('user')
            ->with('illustrable')
            ->orderBy('created_at', 'desc')
            ->skip(0)
            ->take(8)
            ->get();

        $data = [
            'user' => $user,
            'photos' => $photos
        ];

        return view('pages.profile.vues.dashboardBox.boxVues.photos-last', $data);
    }

    // BOX : LES DERNIÈRES VIDÉOS
    function subVueVideosLast($user_id){
        $user = User::where('id',$user_id)->first();

        $videos = Video::where('viewable_type', '!=', 'App\User')
            ->with('user')
            ->with('viewable')
            ->orderBy('created_at', 'desc')
            ->skip(0)
            ->take(4)
            ->get();

        $data = [
            'user' => $user,
            'videos'=>$videos
        ];
        return view('pages.profile.vues.dashboardBox.boxVues.videos-last', $data);
    }

    // BOX : LES DERNIERS COMMENTAIRES
    function subVueCommentsLast($user_id){
        $user = User::where('id',$user_id)->first();

        $descriptions = Description::where('descriptive_type', 'App\Route')
            ->with('descriptive')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->skip(0)
            ->take(5)
            ->get();

        $data = [
            'user' => $user,
            'descriptions' => $descriptions,
        ];
        return view('pages.profile.vues.dashboardBox.boxVues.comments-last', $data);
    }

    // BOX : LES DERNIÈRES LIGNES
    function subVueRoutesLast($user_id){

        $user = User::where('id',$user_id)->first();
        $routes = Route::with('routeSections')
            ->with('user')
            ->with('climb')
            ->with('crag')
            ->skip(0)
            ->take(10)
            ->orderBy('created_at','desc')
            ->get();
        $data = [
            'user' => $user,
            'routes' => $routes,
        ];
        return view('pages.profile.vues.dashboardBox.boxVues.routes-last', $data);

    }

    // BOX : LES DERNIÈRES FALAISES
    function subVueCragsLast($user_id){
        $user = User::where('id',$user_id)->first();
        $crags = Crag::with('user')->orderBy('created_at','desc')->skip(0)->take(5)->get();
        $data = [
            'user' => $user,
            'crags' => $crags
        ];
        return view('pages.profile.vues.dashboardBox.boxVues.crags-last', $data);
    }

    // BOX : LES DERNIERS TOPOS
    function subVueToposLast($user_id){
        $user = User::where('id',$user_id)->first();
        $topos = Topo::with('user')->orderBy('created_at','desc')->skip(0)->take(5)->get();
        $data = [
            'user' => $user,
            'topos' => $topos,
            ];
        return view('pages.profile.vues.dashboardBox.boxVues.topos-last', $data);
    }

    // BOX : LES DERNIERS GRIMPEURS
    function subVueUsersLast($user_id){

        $profile = User::where('id',$user_id)->first();

        $users = [];
        $findUsers = User::orderBy('created_at','desc')->skip(0)->take(5)->get();
        foreach($findUsers as $user){
            if($user->sex == 0) $user->genre = 'Indéfini';
            if($user->sex == 1) $user->genre = 'Femme';
            if($user->sex == 2) $user->genre = 'Homme';
            $user->age = $user->birth != 0 ? date('Y') - $user->birth : '?';
            $users[] = $user;
        }

        $data = ['user' => $profile,'users'=>$users];
        return view('pages.profile.vues.dashboardBox.boxVues.users-last', $data);
    }

    // BOX : LES DERNIÈRES SAE
    function subVueSaeLast($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.sae-last', $data);
    }

    // BOX : LA LISTE DES SITE ET SALLE D'ESCALADE
    function subVueListCragSae($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user];
        return view('pages.profile.vues.dashboardBox.boxVues.list-crag-sae', $data);
    }

    // BOX : RÉSUMÉ DE LA RECHERCHE DE PARTENAIRE
    function subVuePartenaire($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.partenaire', $data);
    }

    // BOX : UN MOT AU HASARD
    function subVueRandomWord($user_id){
        $user = User::where('id',$user_id)->first();
        $word = DB::table('words')->inRandomOrder()->first();
        $data = ['user' => $user,'word'=>$word];
        return view('pages.profile.vues.dashboardBox.boxVues.random-word', $data);
    }




    //********************

    //VUE DE LA MESSAGERIE

    //********************

    function vueConversations(){

        $user = User::where('id',Auth::id())->first();

        $conversations = UserConversation::where('user_id', $user->id)
            ->with('conversation.userConversations.user')
            ->orderBy('new_messages', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();

        $data = [
            'user' => $user,
            'conversations' => $conversations
        ];

        return view('pages.profile.vues.messagerie.conversations', $data);
    }

    function vueMessages(Request $request){
        $user = User::where('id',Auth::id())->first();
        $conversation = Conversation::where('id', $request->input('conversation_id'))->with('messages.user')->with('userConversations.user')->first();

        //on passe à lu la conversation
        $userConversation = UserConversation::where([['user_id', Auth::id()],['conversation_id',$conversation->id]])->first();
        $userConversation->new_messages = 0;
        $userConversation->save();

        $data = [
            'user' => $user,
            'conversation' => $conversation
        ];
        return view('pages.profile.vues.messagerie.messages', $data);
    }

}