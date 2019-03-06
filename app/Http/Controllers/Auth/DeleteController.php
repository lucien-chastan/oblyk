<?php

namespace App\Http\Controllers\Auth;

use App\Album;
use App\Approach;
use App\Conversation;
use App\Crag;
use App\Cross;
use App\CrossSection;
use App\Description;
use App\Exception;
use App\Follow;
use App\Gym;
use App\Http\Controllers\Controller;
use App\Message;
use App\Notification;
use App\Parking;
use App\Photo;
use App\Post;
use App\Route;
use App\Sector;
use App\Tag;
use App\TickList;
use App\Topo;
use App\TopoCrag;
use App\TopoPdf;
use App\TopoSale;
use App\TopoWeb;
use App\UserConversation;
use App\UserPartnerSettings;
use App\UserPlace;
use App\UserSettings;
use App\UserSocialNetwork;
use App\Video;
use App\Word;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{

    public function deleteUserPage(){
        return view('auth.delete');
    }

    public function userDeletedPage(){
        return view('auth.confirm-delete');
    }

    public function deleteConnectedUser(){

        $user = Auth::user();
        Auth::logout();

        $oblyk_id = config('app.oblyk_id');

        //Ce qui est transferé
        Album::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Approach::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Photo::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Video::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Crag::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Sector::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Exception::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Gym::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Word::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Parking::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Route::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        TopoSale::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        TopoPdf::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        TopoWeb::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        TopoCrag::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Tag::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);
        Topo::where('user_id', $user->id)->update(['user_id' => $oblyk_id]);

        //Ce qui est supprimé
        Description::where('user_id', $user->id)->get()->each(function($description) { $description->delete(); });
        Cross::where('user_id', $user->id)->get()->each(function ($cross) { $cross->delete();});
        Follow::where('user_id', $user->id)->get()->each(function ($follow) { $follow->delete(); });
        UserConversation::where('user_id', $user->id)->get()->each(function ($userConversation) { $userConversation->delete();});
        Notification::where('user_id', $user->id)->delete();
        UserPartnerSettings::where('user_id', $user->id)->delete();
        UserPlace::where('user_id', $user->id)->delete();
        Post::where('user_id', $user->id)->get()->each(function($post) {$post->delete();});
        Notification::where('user_id', $user->id)->delete();
        UserSettings::where('user_id', $user->id)->delete();
        UserSocialNetwork::where('user_id', $user->id)->delete();
        TickList::where('user_id', $user->id)->delete();

        //Préfixage du user en soft delete
        $user->name .= '_deleting_' . date('yyyy-mm-dd_H-i-s');
        $user->email .= '_deleting_' . date('yyyy-mm-dd_H-i-s');
        $user->save();

        $user->delete();

        return redirect()->route('userDeletedPage');

    }
}
