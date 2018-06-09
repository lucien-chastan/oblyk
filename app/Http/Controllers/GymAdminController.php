<?php

namespace App\Http\Controllers;

use App\Gym;
use App\GymRoom;

class GymAdminController extends Controller
{

    // LAYOUT
    public function layoutPage($gym_id){
        return view('pages.gym-admin.home', ['gym' => Gym::find($gym_id)]);
    }

    // VIEW
    public function dashboardView($gym_id){
        return view('pages.gym-admin.vues.dashboard', ['gym' => Gym::find($gym_id)]);
    }

    // LOGO AND BANDEAU
    public function uploadLogoBandeauView($gym_id){
        return view('pages.gym-admin.vues.upload', ['gym' => Gym::find($gym_id)]);
    }

    // SCHEMES
    public function howSchemeView($gym_id){
        return view('pages.gym-admin.vues.how', ['gym' => Gym::find($gym_id)]);
    }

    public function gymSchemesView($gym_id){

        $gym = Gym::where('id',$gym_id)
            ->withCount('rooms')
            ->with('rooms')
            ->first();

        return view('pages.gym-admin.vues.schemes', ['gym' => $gym]);
    }

    public function gymSchemeView($gym_id, $room_id){
        return view('pages.gym-admin.vues.scheme',
            [
                'gym' => Gym::find($gym_id),
                'room' => GymRoom::find($room_id),
            ]
        );
    }
}
