<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function userPage($user_id, $user_title){

        $user = User::where('id', $user_id)->first();

        $data = [
            'user' => $user,
            'meta_title' => $user['name'],
            'meta_description' => 'description de ' . $user['name']
        ];

        return view('pages.profile.profile', $data);
    }
}
