<?php

namespace App\Http\Controllers;

use App\Gym;
use App\GymRoute;
use App\IndoorCross;
use Illuminate\Support\Facades\Auth;

class GymRouteController extends Controller
{
    function gymRoutePage($gym_id, $route_id)
    {
        $Gym = Gym::class;
        $GymRoute = GymRoute::class;
        $Cross = IndoorCross::class;

        $gym = $Gym::find($gym_id);
        $route = $GymRoute::where('id', $route_id)
            ->with('sector')
            ->with('descriptions')
            ->with('sector.room')
            ->first();

        $crosses = $Cross::where([['user_id', Auth::id()], ['route_id', $route->id]])->get();

        $data = [
            'gym' => $gym,
            'crosses' => $crosses,
            'route' => $route,
        ];

        return view('pages.gym.gym-route', $data);
    }
}
