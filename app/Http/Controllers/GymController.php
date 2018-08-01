<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Cross;
use App\Follow;
use App\Gym;
use App\TickList;
use App\User;
use App\UserPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GymController extends Controller
{
    function gymPage($gym_id, $gym_title){

        $gym = Gym::where('id', $gym_id)
            ->withCount('links')
            ->withCount('photos')
            ->withCount('videos')
            ->withCount('posts')
            ->with('photos')
            ->with('descriptions.user')
            ->first();

        // Si le label à changé alors on redirige
        if(Gym::webUrl($gym_id, $gym_title) != $gym->url()) {
            return $this->gymRedirectionPage($gym_id);
        }

        $gymType = '';
        if($gym->type_boulder == 1 && $gym->type_route == 1) $gymType = '<span class="type-bloc text-bold">' . trans('elements/climbs.climb_2') . '</span>, <span class="type-voie text-bold">' . trans('elements/climbs.climb_3') . '</span>';
        if($gym->type_boulder == 0 && $gym->type_route == 1) $gymType = '<span class="type-voie text-bold">' . trans('elements/climbs.climb_3') . '</span>';
        if($gym->type_boulder == 1 && $gym->type_route == 0) $gymType = '<span class="type-bloc text-bold">' . trans('elements/climbs.climb_2') . '</span>';

        $partners = User::whereIn('id', UserPlace::getPartnersAroundCenter($gym->lat, $gym->lng))->get();

        $user = User::where('id',Auth::id())->with('partnerSettings')->first();

        //on va chercher si l'utilisateur follow ce site
        $userFollow = Follow::where(
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
        $gym->type = $gymType;

        $data = [
            'gym' => $gym,
            'user' => $user,
            'meta_title' => $gym['label'],
            'meta_description' => 'description de ' . $gym['label'],
            'user_follow' => $userFollow,
            'partners' => $partners,
        ];

        return view('pages.gym.gym', $data);
    }

    public function gymRedirectionPage($gym_id) {
        $gym = Gym::find($gym_id);
        return redirect($gym->url(),301);
    }
}
