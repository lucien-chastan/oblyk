<?php

namespace App\Http\Controllers;

use App\Notification;
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

        //compte du nombre de message non lu
        $userConversation = UserConversation::where([
            ['user_id', Auth::id()],
            ['new_messages', 1]
        ])->get();

        //compte le nombre de notification
        $notifications = Notification::where([
            ['user_id', Auth::id()],
            ['read', 0]
        ])->get();

        $data = [
            'notifications'=>count($notifications),
            'messages'=>count($userConversation),
        ];

        return response()->json($data);
    }
}
