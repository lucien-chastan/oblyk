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
use App\Lib\HelpersTemplates;

class GymSchemeController extends Controller
{
    function schemePage($gym_id, $room_id)
    {
        $Gym = Gym::class;
        $GymRoom = GymRoom::class;

        $gym = $Gym::find($gym_id)->with('rooms')->withCount('rooms')->first();
        $room = $GymRoom::find($room_id);
        $rooms = $GymRoom::where('gym_id', $gym_id)->orderBy('order')->get();

        if ($gym->id != $room->gym_id) return redirect($gym->url());

        $bannerRGBA = HelpersTemplates::hexToRgb(
            $room->banner_bg_color ?? env('ROOM_BANNER_BG_COLOR'),
            $room->banner_opacity ?? env('ROOM_BANNER_OPACITY')
        );

        $colors = [
            'bgSchemeColor' => $room->scheme_bg_color ?? env('ROOM_SCHEME_BG_COLOR'),
            'bannerColor' => $room->banner_color ?? env('ROOM_BANNER_COLOR'),
            'bannerBgColor' => 'rgba(' . join(',', $bannerRGBA) . ')',
        ];

        $data = [
            'gym' => $gym,
            'room' => $room,
            'rooms' => $rooms,
            'colors' => $colors
        ];

        return view('pages.gym.gym-scheme', $data);
    }

    function getGymSectorsView($room_id)
    {
        $GymSector = GymSector::class;
        $Gym = Gym::class;
        $Room = GymRoom::class;

        $room = $Room::find($room_id);
        $gym = $Gym::find($room->gym_id);

        return view('pages.gym.vues.sectorsVue', [
            'sectors' => $GymSector::where('room_id', $room_id)
                ->withCount('routes')
                ->get(),
            'gym' => $gym,
            'room' => $room
        ]);
    }

    function getGymSectorView($sector_id)
    {
        $GymSector = GymSector::class;
        $Gym = Gym::class;

        $gymSector = $GymSector::where('id', $sector_id)
            ->withCount('routes')
            ->with('routes')
            ->with('room')
            ->first();

        $gym = $Gym::find($gymSector->room->gym_id);

        return view('pages.gym.vues.sectorVue', [
            'sector' => $gymSector,
            'gym' => $gym
        ]);
    }

    function getGymRouteView($route_id)
    {
        $GymRoute = GymRoute::class;
        return view('pages.gym.vues.routeVue', [
            'route' => $GymRoute::where('id', $route_id)->with('sector')->first()
        ]);
    }

    function getGymSectors($room_id)
    {
        $GymSector = GymSector::class;
        $sectors = $GymSector::where([['room_id', '=', $room_id], ['area', '!=', null]])->get();
        return response()->json(['sectors' => $sectors]);
    }

    function getLastCreatedRoomRoute($gym_id)
    {
        $GymRoom = GymRoom::class;
        $room = $GymRoom::where('gym_id', $gym_id)->orderBy('created_at', 'desc')->first();

        return response()->json(['route' => $room->url()]);
    }

    function getFirstOrderRoomRoute($gym_id)
    {
        $GymRoom = GymRoom::class;
        $room = $GymRoom::where('gym_id', $gym_id)->orderBy('order')->first();

        return response()->json(['route' => $room->url()]);
    }
}
