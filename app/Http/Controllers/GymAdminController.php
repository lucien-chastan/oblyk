<?php

namespace App\Http\Controllers;

use App\Gym;
use App\GymRoom;
use App\GymSector;

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
                'room' => GymRoom::where('id',$room_id)
                    ->withCount('sectors')
                    ->with('sectors')
                    ->first(),
            ]
        );
    }

    public function gymSectorRoutesView($gym_id, $sector_id){
        return view('pages.gym-admin.vues.sector-routes',
            [
                'gym' => Gym::find($gym_id),
                'sector' => GymSector::where('id',$sector_id)
                    ->withCount('routes')
                    ->with('routes')
                    ->first(),
            ]
        );
    }

    public function gymRoutesView ($gym_id) {
        return view('pages.gym-admin.vues.routes', ['gym' => Gym::find($gym_id)]);
    }

    public function gymFluxView ($gym_id) {
        return view('pages.gym-admin.vues.flux', ['gym' => Gym::find($gym_id)]);
    }

    public function gymCommunityView ($gym_id) {
        return view('pages.gym-admin.vues.community', ['gym' => Gym::find($gym_id)]);
    }

    public function gymStatisticView ($gym_id) {
        return view('pages.gym-admin.vues.statistic', ['gym' => Gym::find($gym_id)]);
    }

    // GESTION
    public function gymTeamView ($gym_id) {
        return view('pages.gym-admin.vues.team', ['gym' => Gym::find($gym_id)]);
    }

    public function gymSettingsView ($gym_id) {
        return view('pages.gym-admin.vues.settings', ['gym' => Gym::find($gym_id)]);
    }
}
