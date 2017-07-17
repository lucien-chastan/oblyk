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
    function userPage($user_id, $user_title){

        $user = User::where('id', $user_id)->first();

        if($user->sex == 0) $user->genre = 'Inféfini';
        if($user->sex == 1) $user->genre = 'Femme';
        if($user->sex == 2) $user->genre = 'Homme';

        $user->age = $user->birth != 0 ? date('Y') - $user->birth : '?';

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
        $crags = $users = $topos = $massives = [];

        //Liste des id dans les éléments que l'utilisateur suit
        foreach ($user->follows as $follow){
            if($follow->followed_type == 'App\\Crag') $crags[] = $follow->followed_id;
            if($follow->followed_type == 'App\\Topo') $topos[] = $follow->followed_id;
            if($follow->followed_type == 'App\\User') $users[] = $follow->followed_id;
            if($follow->followed_type == 'App\\Massive') $massives[] = $follow->followed_id;
        }

        $last_read = $user->last_fil_read;

        $posts = Post::where(function ($query) use ( $crags, $last_read ) {$query->where([['postable_type', '=', 'App\\Crag'],['created_at','>',$last_read]])->whereIn('postable_id', $crags);})
            ->orWhere(function ($query) use ( $topos, $last_read ) {$query->where([['postable_type', '=', 'App\\Topo'],['created_at','>',$last_read]])->whereIn('postable_id', $topos);})
            ->orWhere(function ($query) use ( $users, $last_read ) {$query->where([['postable_type', '=', 'App\\User'],['created_at','>',$last_read]])->whereIn('postable_id', $users);})
            ->orWhere(function ($query) use ( $massives, $last_read ) {$query->where([['postable_type', '=', 'App\\Massive'],['created_at','>',$last_read]])->whereIn('postable_id', $massives);})
            ->count();

        $data = [
            'notifications'=>$notifications,
            'messages'=>$userConversation,
            'posts'=>$posts
        ];

        return response()->json($data);
    }
}
