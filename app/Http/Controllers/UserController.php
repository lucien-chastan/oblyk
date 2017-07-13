<?php

namespace App\Http\Controllers;

use App\User;
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

        $data = [
            'user' => $user,
            'meta_title' => $user['name'],
            'meta_description' => 'description de ' . $user['name']
        ];

        return view('pages.profile.profile', $data);
    }
}
