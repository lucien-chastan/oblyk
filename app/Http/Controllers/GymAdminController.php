<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Gym;
use App\GymAdministrator;
use App\GymGrade;
use App\GymRoom;
use App\GymRoute;
use App\GymSector;

class GymAdminController extends Controller
{

    // LAYOUT
    public function layoutPage($gym_id)
    {
        $Gym = Gym::class;
        return view('pages.gym-admin.home', ['gym' => $Gym::find($gym_id)]);
    }

    // VIEW
    public function dashboardView($gym_id)
    {
        $Gym = Gym::class;
        return view('pages.gym-admin.vues.dashboard', ['gym' => $Gym::find($gym_id)]);
    }

    // LOGO AND BANDEAU
    public function uploadLogoBandeauView($gym_id)
    {
        $Gym = Gym::class;
        return view('pages.gym-admin.vues.upload', ['gym' => $Gym::find($gym_id)]);
    }

    // SCHEMES
    public function howSchemeView($gym_id)
    {
        $Gym = Gym::class;
        return view('pages.gym-admin.vues.how', ['gym' => $Gym::find($gym_id)]);
    }

    public function gymSchemesView($gym_id)
    {
        $Gym = Gym::class;

        $gym = $Gym::where('id',$gym_id)
            ->withCount('rooms')
            ->with('grades')
            ->with('rooms')
            ->first();

        return view('pages.gym-admin.vues.schemes', ['gym' => $gym]);
    }

    public function gymRoutesView ($gym_id)
    {
        $Gym = Gym::class;
        $Route = GymRoute::class;
        $Room = GymRoom::class;
        $Sector = GymSector::class;

        $roomsArray = $Room::where('gym_id', $gym_id)->select('id')->get()->toArray();
        $routes = $Route::whereIn('sector_id', $Sector::whereIn('room_id', $roomsArray)->select('id')->get()->toArray())
            ->with('sector')
            ->with('sector.room')
            ->withCount('descriptions')
            ->orderBy('opener_date', 'desc')
            ->get();

        return view('pages.gym-admin.vues.routes', [
            'gym' => $Gym::find($gym_id),
            'routes' => $routes
        ]);
    }

    public function gymFluxView ($gym_id)
    {
        $Gym = Gym::class;
        return view('pages.gym-admin.vues.flux', ['gym' => $Gym::find($gym_id)]);
    }

    public function gymCommunityView ($gym_id)
    {
        $Gym = Gym::class;
        $Follow = Follow::class;

        $followers = $Follow::where([['followed_id', '=', $gym_id], ['followed_type', '=', 'App\Gym']])
            ->with('user')
            ->get();

        return view('pages.gym-admin.vues.community', [
            'followers' => $followers,
            'gym' => $Gym::find($gym_id),
        ]);
    }

    public function gymStatisticView ($gym_id)
    {
        $Gym = Gym::class;
        return view('pages.gym-admin.vues.statistic', ['gym' => $Gym::find($gym_id)]);
    }

    // GESTION
    public function gymTeamView ($gym_id)
    {
        $Gym = Gym::class;
        $GymAdministrator = GymAdministrator::class;

        $administrators = $GymAdministrator::where('gym_id', $gym_id)
            ->with('user')
            ->get();

        return view('pages.gym-admin.vues.team', [
            'gym' => $Gym::find($gym_id),
            'administrators' => $administrators
        ]);
    }

    public function gymSettingsView ($gym_id)
    {
        $Gym = Gym::class;
        return view('pages.gym-admin.vues.settings', ['gym' => $Gym::find($gym_id)]);
    }

    public function gymGradesView ($gym_id) {
        $Gym = Gym::class;
        $Grade = GymGrade::class;
        return view('pages.gym-admin.vues.grades', [
            'gym' => $Gym::find($gym_id),
            'grades' => $Grade::where('gym_id', $gym_id)->with(['gradeLines' => function ($query) { $query->orderBy('order'); }])->get()
        ]);
    }

    public function gymGradeLinesView ($gym_id, $gym_grade_id) {
        $Gym = Gym::class;
        $Grade = GymGrade::class;
        return view('pages.gym-admin.vues.grade-lines', [
            'gym' => $Gym::find($gym_id),
            'grade' => $Grade::find($gym_grade_id)->with(['gradeLines' => function ($query) { $query->orderBy('order'); }])->first()
        ]);
    }
}
