<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Post;
use App\User;
use App\UserConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function userPage($user_id, $user_title){

        $user = User::where('id', $user_id)->first();

        // Si le label à changé alors on redirige
        if(User::webUrl($user_id, $user_title) != $user->url()) {
            return $this->userRedirectionPage($user_id);
        }

        $user->genre = ($user->sex != null) ? trans('elements/sex.sex_' . $user->sex) : trans('elements/sex.sex_0');
        $user->age = $user->birth != 0 ? trans_choice('elements/old.old', date('Y') - $user->birth) : trans_choice('elements/old.old', 0);

        $user->image = file_exists(storage_path('app/public/users/100/user-' . $user->id . '.jpg')) ? '/storage/users/100/user-' . $user->id . '.jpg' : '/img/icon-search-user.svg';
        $user->bandeau = file_exists(storage_path('app/public/users/1300/bandeau-' . $user->id . '.jpg')) ? '/storage/users/1300/bandeau-' . $user->id . '.jpg' : '';

        //compte du nombre de message non lu
        $userConversation = UserConversation::where([['user_id',$user->id],['new_messages',1]])->get();

        $data = [
            'user' => $user,
            'meta_title' => $user['name'],
            'meta_description' => 'description de ' . $user['name'],
            'count_messages' => count($userConversation)
        ];

        return view('pages.profile.profile', $data);
    }


    //regarde les nouvelles notifications et messages
    function getNewNotificationAndMessage(){

        $user = User::where('id', Auth::id())->with('follows')->first();

        //compte du nombre de message non lu
        $userConversation = UserConversation::where([
            ['user_id', $user->id],
            ['new_messages', 1]
        ])->count();

        //compte le nombre de notification
        $notifications = Notification::where([
            ['user_id', $user->id],
            ['read', 0]
        ])->count();

        //compte le nombre de nouvelle actualite
        $crags = $users = $topos = $massives = $topics = $gyms = [];

        //Liste des id dans les éléments que l'utilisateur suit
        foreach ($user->follows as $follow){
            if($follow->followed_type == 'App\\Crag') $crags[] = $follow->followed_id;
            if($follow->followed_type == 'App\\Topo') $topos[] = $follow->followed_id;
            if($follow->followed_type == 'App\\User') $users[] = $follow->followed_id;
            if($follow->followed_type == 'App\\Massive') $massives[] = $follow->followed_id;
            if($follow->followed_type == 'App\\ForumTopic') $topics[] = $follow->followed_id;
            if($follow->followed_type == 'App\\Gym') $gyms[] = $follow->followed_id;
        }

        $last_read = $user->last_fil_read;

        $posts = Post::where(function ($query) use ( $crags, $last_read ) {$query->where([['postable_type', '=', 'App\\Crag'],['created_at','>',$last_read]])->whereIn('postable_id', $crags);})
            ->orWhere(function ($query) use ( $topos, $last_read ) {$query->where([['postable_type', '=', 'App\\Topo'],['created_at','>',$last_read]])->whereIn('postable_id', $topos);})
            ->orWhere(function ($query) use ( $users, $last_read ) {$query->where([['postable_type', '=', 'App\\User'],['created_at','>',$last_read]])->whereIn('postable_id', $users);})
            ->orWhere(function ($query) use ( $massives, $last_read ) {$query->where([['postable_type', '=', 'App\\Massive'],['created_at','>',$last_read]])->whereIn('postable_id', $massives);})
            ->orWhere(function ($query) use ( $topics, $last_read ) {$query->where([['postable_type', '=', 'App\\ForumTopic'],['created_at','>',$last_read]])->whereIn('postable_id', $topics);})
            ->orWhere(function ($query) use ( $gyms, $last_read ) {$query->where([['postable_type', '=', 'App\\Gym'],['created_at','>',$last_read]])->whereIn('postable_id', $gyms);})
            ->orWhere([['postable_type','App\\User'],['postable_id',$user->id],['created_at','>',$last_read]])
            ->count();

        $data = [
            'notifications'=>$notifications,
            'messages'=>$userConversation,
            'posts'=>$posts
        ];

        return response()->json($data);
    }

    public function userRedirectionPage($user_id) {
        $user = User::find($user_id);
        return redirect($user->url(),301);
    }
}
