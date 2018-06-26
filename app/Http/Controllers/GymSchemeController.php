<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Cross;
use App\Follow;
use App\Gym;
use App\GymRoom;
use App\GymRoute;
use App\GymSector;
use App\TickList;
use App\User;
use App\UserPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GymSchemeController extends Controller
{
    function schemePage($gym_id, $room_id){

        $gym = Gym::find($gym_id);
        $room = GymRoom::find($room_id);

        $data = [
            'gym' => $gym,
            'room' => $room
        ];

        return view('pages.gym.gym-scheme', $data);
    }

    function getGymSectorsView($room_id) {
        return view('pages.gym.vues.sectorsVue', [
            'sectors' => GymSector::where('room_id',$room_id)
                ->withCount('routes')
                ->get()
        ]);
    }

    function getGymSectorView($sector_id) {
        return view('pages.gym.vues.sectorVue', [
            'sector' => GymSector::where('id',$sector_id)
                ->withCount('routes')
                ->with('routes')
                ->first()
        ]);
    }

    function getGymRouteView($route_id) {
        return view('pages.gym.vues.routeVue', [
            'route' => GymRoute::find($route_id)
        ]);
    }

    function getGymSectors($room_id) {
        $sectors = GymSector::where([['room_id','=',$room_id], ['area','!=',null]])->get();
        return response()->json(['sectors' => $sectors]);
    }
}