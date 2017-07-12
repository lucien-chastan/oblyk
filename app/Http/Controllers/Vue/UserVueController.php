<?php

namespace App\Http\Controllers\Vue;

use App\Crag;
use App\Topo;
use App\User;
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

    function vuePersonnaliserDashboard($user_id){

        $user = User::where('id',$user_id)->with('settings')->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.personnaliserDashboardVue', $data);

    }

    function vueFilActu($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.filActuVue', $data);

    }

    function vuePhotos($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.photosVue', $data);

    }

    function vueVideos($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.videosVue', $data);

    }

    function vueCroix($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.croixVue', $data);

    }

    function vueTickList($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.tickListVue', $data);

    }

    function vueProjet($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.projetVue', $data);

    }

    function vueAnalytiks($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.analytiksVue', $data);

    }

    function vueMessages($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.messagesVue', $data);

    }

    function vueMessageParametres($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.messageParametresVue', $data);

    }

    function vueLieux($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.lieuxVue', $data);

    }

    function vuePartenaireParametres($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.partenaireParametresVue', $data);

    }

    function vueNotifications($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.notificationsVue', $data);

    }

    function vueEditProfile($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.editProfileVue', $data);

    }

    function vueDeleteProfile($user_id){

        $user = User::where('id',$user_id)->first();
        $data = ['user' => $user,];
        return view('pages.profile.vues.deleteProfileVue', $data);

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
        $data = ['user' => $user,];
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
        $crags = Crag::where('id','>','0')->with('user')->orderBy('created_at','desc')->skip(0)->take(10)->get();
        $data = [
            'user' => $user,
            'crags' => $crags
        ];
        return view('pages.profile.vues.dashboardBox.boxVues.crags-last', $data);
    }

    function subVueToposLast($user_id){
        $user = User::where('id',$user_id)->first();
        $topos = Topo::where('id','>',0)->with('user')->orderBy('created_at','desc')->skip(0)->take(10)->get();
        $data = [
            'user' => $user,
            'topos' => $topos,
            ];
        return view('pages.profile.vues.dashboardBox.boxVues.topos-last', $data);
    }

    function subVueUsersLast($user_id){
        $user = User::where('id',$user_id)->first();
        $users = User::where('id','>',0)->orderBy('created_at','desc')->skip(0)->take(10)->get();
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
}