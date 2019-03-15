<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Gym;
use App\GymRoom;
use App\IndoorCross;
use App\User;
use App\UserPlace;
use Illuminate\Support\Facades\Auth;

class GymController extends Controller
{
    function gymPage($gym_id, $gym_title)
    {
        $Gym = Gym::class;
        $GymRoom = GymRoom::class;
        $User = User::class;
        $UserPlace = UserPlace::class;
        $Follow = Follow::class;
        $Cross = IndoorCross::class;

        $gym = $Gym::where('id', $gym_id)
            ->withCount('links')
            ->withCount('photos')
            ->withCount('videos')
            ->withCount('posts')
            ->withCount('rooms')
            ->with('photos')
            ->with('descriptions.user')
            ->first();

        $firstRoom = $GymRoom::where([['gym_id', $gym->id], ['published_at', '!=', null]])->orderBy('order')->first();

        // If gym name is not a good name, then redirection
        if(Gym::webUrl($gym_id, $gym_title) != $gym->url()) {
            return $this->gymRedirectionPage($gym_id);
        }

        $partners = $User::whereIn('id', $UserPlace::getPartnersAroundCenter($gym->lat, $gym->lng))->get();

        $user = $User::where('id',Auth::id())->with('partnerSettings')->first();

        //on va chercher si l'utilisateur follow ce site
        $userFollow = $Follow::where(
            [
                ['user_id', '=', Auth::id()],
                ['followed_type', '=', 'App\Gym'],
                ['followed_id', '=', $gym->id]
            ]
        )->first();
        $userFollow = (isset($userFollow)) ? 'true' : 'false';

        //on ajoute une vue à la falaise
        $gym->views++;
        $gym->save();

        $gym->bandeau = file_exists(storage_path('app/public/gyms/1300/bandeau-' . $gym->id . '.jpg')) ? '/storage/gyms/1300/bandeau-' . $gym->id . '.jpg' : '/img/default-gym-bandeau.jpg';
        $gym->logo = file_exists(storage_path('app/public/gyms/100/logo-' . $gym->id . '.png')) ? '/storage/gyms/100/logo-' . $gym->id . '.png' : '/img/icon-gym.svg';

        $crosses = $Cross::where([['user_id', Auth::id()], ['gym_id', $gym->id]])->get();
        if (count($crosses) > 0) {
            $crossesHeight = $Cross::where([['user_id', Auth::id()], ['gym_id', $gym->id]])->sum('height');
            $crossesMaxGrade = $Cross::where([['user_id', Auth::id()], ['gym_id', $gym->id]])->max('grade_val');
        }

        $data = [
            'gym' => $gym,
            'crosses' => $crosses,
            'crossesHeight' => $crossesHeight ?? 0,
            'crossesMaxGrade' => $crossesMaxGrade ?? 0,
            'user' => $user,
            'firstRoom' => $firstRoom,
            'meta_title' => $gym['label'],
            'meta_description' => 'description de ' . $gym['label'],
            'user_follow' => $userFollow,
            'partners' => $partners,
            'is_administrator' => $gym->userIsAdministrator(Auth::id()),
            'administrator_count' => $gym->countAdministrator(),
        ];

        return view('pages.gym.gym', $data);
    }

    public function gymRedirectionPage($gym_id) {
        $Gym = Gym::class;
        $gym = $Gym::find($gym_id);
        return redirect($gym->url(),301);
    }
}
