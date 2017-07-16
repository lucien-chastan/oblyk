<?php

namespace App\Http\Controllers\Vue;

use App\Album;
use App\Article;
use App\Conversation;
use App\Crag;
use App\Notification;
use App\TickList;
use App\Topo;
use App\User;
use App\UserConversation;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserVueController extends Controller
{
    function vueFollow($user_id){

        $user = User::where('id',$user_id)->with('follows.followed')->first();

        $follows = [];
        foreach ($user->follows as $follow){

            $catTitre = '';

            //FALAISE
            if($follow->followed_type == 'App\Crag'){
                $follow->followUrl = route('cragPage', ['crag_id'=>$follow->followed_id, 'crag_label'=>str_slug($follow->followed->label)]);
                $follow->followName = $follow->followed->label;
                $follow->followIcon = ($follow->followed->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $follow->followed->bandeau);
                $follow->followInformation = $follow->followed->region . ', ' . ($follow->followed->code_country);
                $catTitre = 'sites';
            }

            //TOPO
            if($follow->followed_type == 'App\Topo'){
                $follow->followUrl = route('topoPage', ['topo_id'=>$follow->followed_id, 'topo_label'=>str_slug($follow->followed->label)]);
                $follow->followName = $follow->followed->label;
                $follow->followIcon = (file_exists(storage_path('app/public/topos/50/topo-' . $follow->followed->id . '.jpg'))) ? '/storage/topos/50/topo-' . $follow->followed->id . '.jpg' : '/img/default-topo-couverture.svg';
                $follow->followInformation = $follow->followed->editor . ', ' . $follow->followed->editionYear;
                $catTitre = 'topos';
            }

            //MASSIF
            if($follow->followed_type == 'App\Massive'){
                $follow->followUrl = route('massivePage', ['massive_id'=>$follow->followed_id, 'massive_label'=>str_slug($follow->followed->label)]);
                $follow->followName = $follow->followed->label;
                $follow->followIcon = '/img/icon-search-massive.svg';
                $follow->followInformation = 'regroupement de site';
                $catTitre = 'regroupements';
            }

            $follows[$catTitre][] = $follow;
        }

        $data = [
            'user' => $user,
            'follows' => $follows
        ];

        return view('pages.profile.vues.followVue', $data);
    }


    function vueDashboard($user_id){

        $user = User::where('id',$user_id)->with('settings')->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardVue', $data);

    }

    function vueFilActu($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.filActuVue', $data);

    }

    function vueAlbums($user_id){

        $user = User::where('id',$user_id)->with('albums')->with('albums.photos')->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.albumsVue', $data);

    }

    function vuePhotos($user_id, $album_id){

        $user = User::where('id',$user_id)->with('albums')->with('albums.photos')->first();
        $album = Album::where('id',$album_id)->with('photos')->first();
        $data = [
            'user' => $user,
            'album' => $album
        ];
        return view('pages.profile.vues.photosVue', $data);

    }

    function vueVideos($user_id){

        $user = User::where('id',$user_id)->with('videos')->with('videos.viewable')->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.videosVue', $data);

    }

    function vueCroix($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.croixVue', $data);

    }

    function vueTickList($user_id){

        $tickLists = TickList::where('user_id',$user_id)->with('route.crag')->with('route.routeSections')->get();

        $crags = [];

        foreach ($tickLists as $ticks){
            $crags[$ticks->route->crag_id][] = $ticks;
        }

        $data = [
            'crags' => $crags
        ];

        return view('pages.profile.vues.tickListVue', $data);

    }

    function vueProjet($user_id){

        $user = User::where('id',Auth::id())->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.projetVue', $data);

    }

    function vueAnalytiks($user_id){

        $user = User::where('id',Auth::id())->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.analytiksVue', $data);

    }

    function vueMessagerie($user_id){

        $user = User::where('id',Auth::id())->first();
        $data = ['user' => $user];
        return view('pages.profile.vues.messagesVue', $data);

    }

    function vueLieux($user_id){

        $user = User::where('id',Auth::id())->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.lieuxVue', $data);

    }

    function vuePartenaireParametres($user_id){

        $user = User::where('id',Auth::id())->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.partenaireParametresVue', $data);

    }

    function vueNotifications($user_id){

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

    }

    function vueSettings($user_id){

        $user = User::where('id',Auth::id())->with('settings')->with('socialNetworks.socialNetwork')->first();

        $user->image = file_exists(storage_path('app/public/users/100/user-' . $user->id . '.jpg')) ? '/storage/users/100/user-' . $user->id . '.jpg' : '/img/icon-search-user.svg';
        $user->bandeau = file_exists(storage_path('app/public/users/1300/bandeau-' . $user->id . '.jpg')) ? '/storage/users/1300/bandeau-' . $user->id . '.jpg?cache=' . date('Ymdhis') : '';

        $data = ['user' => $user,];
        return view('pages.profile.vues.settingsVue', $data);

    }




    //LES SOUS VUES DU DASHBOARD

    function subVueWelcome($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.welcome', $data);
    }

    function subVueCroixPote($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.croixPote', $data);
    }

    function subVueMesCroix($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.mesCroix', $data);
    }

    function subVueForumLast($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.forum-last', $data);
    }

    function subVueNewsOblyk($user_id){
        $user = User::where('id',$user_id)->first();
        $articles = Article::where([['id','>','0'],['publish','=',1]])->withCount('descriptions')->orderBy('created_at','desc')->skip(0)->take(3)->get();

        $data = [
            'user' => $user,
            'articles' => $articles,
        ];

        return view('pages.profile.vues.dashboardBox.boxVues.news-oblyk', $data);
    }

    function subVuephotosLast($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.photos-last', $data);
    }

    function subVueVideosLast($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.videos-last', $data);
    }

    function subVueCommentsLast($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.comments-last', $data);
    }

    function subVueRoutesLast($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.routes-last', $data);
    }

    function subVueCragsLast($user_id){
        $user = User::where('id',$user_id)->first();
        $crags = Crag::where('id','>','0')->with('user')->orderBy('created_at','desc')->skip(0)->take(5)->get();
        $data = [
            'user' => $user,
            'crags' => $crags
        ];
        return view('pages.profile.vues.dashboardBox.boxVues.crags-last', $data);
    }

    function subVueToposLast($user_id){
        $user = User::where('id',$user_id)->first();
        $topos = Topo::where('id','>',0)->with('user')->orderBy('created_at','desc')->skip(0)->take(5)->get();
        $data = [
            'user' => $user,
            'topos' => $topos,
            ];
        return view('pages.profile.vues.dashboardBox.boxVues.topos-last', $data);
    }

    function subVueUsersLast($user_id){
        $user = User::where('id',$user_id)->first();
        $users = User::where('id','>',0)->orderBy('created_at','desc')->skip(0)->take(5)->get();
        $data = ['user' => $user,'users'=>$users];
        return view('pages.profile.vues.dashboardBox.boxVues.users-last', $data);
    }

    function subVueSaeLast($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.sae-last', $data);
    }

    function subVueListCragSae($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user];
        return view('pages.profile.vues.dashboardBox.boxVues.list-crag-sae', $data);
    }

    function subVuePartenaire($user_id){
        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.dashboardBox.boxVues.partenaire', $data);
    }

    function subVueRandomWord($user_id){
        $user = User::where('id',$user_id)->first();
        $word = DB::table('words')->inRandomOrder()->first();
        $data = ['user' => $user,'word'=>$word];
        return view('pages.profile.vues.dashboardBox.boxVues.random-word', $data);
    }


    //FONCTION AJAX LIÉ À LA MESSAGERIE
    function vueConversations(){
        $user = User::where('id',Auth::id())->first();
        $conversations = UserConversation::where('user_id', $user->id)->with('conversation.userConversations.user')->orderBy('new_messages', 'desc')->get();
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