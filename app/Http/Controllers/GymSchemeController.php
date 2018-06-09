<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Cross;
use App\Follow;
use App\Gym;
use App\GymRoom;
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

    function getGymSectors($gym_id) {
        $sectors = GymSector::where('gym_id',$gym_id)->get();
        return response()->json(['sectors' => $sectors]);
    }
}
