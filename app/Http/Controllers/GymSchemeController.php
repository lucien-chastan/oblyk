<?php

namespace App\Http\Controllers;

use App\Gym;
use App\GymRoom;
use App\GymRoute;
use App\GymSector;
use App\IndoorCross;
use App\Lib\HelpersTemplates;
use Illuminate\Support\Facades\Auth;

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
        $GymRoute = GymRoute::class;

        $room = $Room::find($room_id);
        $gym = $Gym::find($room->gym_id);
        $routes = $GymRoute::whereIn(
            'sector_id',
            $GymSector::where('room_id', $room_id)->select('id')->get()->toArray())
            ->where('dismounted_at', null)
            ->with('sector')
            ->orderBy('opener_date', 'desc')
            ->get();

        $gymSectors = $GymSector::where('room_id', $room_id)
            ->withCount(['routes' => function ($query) {$query->where('dismounted_at', null);}])
            ->get();

        return view('pages.gym.vues.sectorsVue', [
            'sectors' => $gymSectors,
            'gym' => $gym,
            'room' => $room,
            'routes' => $routes
        ]);
    }

    function getGymSectorView($sector_id)
    {
        $GymSector = GymSector::class;
        $Gym = Gym::class;
        $GymRoute = GymRoute::class;
        $Cross = IndoorCross::class;

        $gymSector = $GymSector::where('id', $sector_id)
            ->with('room')
            ->first();

        $gymRoutes = $GymRoute::where([['sector_id', $gymSector->id], ['dismounted_at', null]])
            ->with(['crosses' => function($query) {$query->where('user_id', Auth::id());}])
            ->orderBy('opener_date')
            ->get();

        $gymSector->routes = $gymRoutes;
        $gymSector->routes_count = count($gymRoutes);

        $gym = $Gym::find($gymSector->room->gym_id);

        return view('pages.gym.vues.sectorVue', [
            'sector' => $gymSector,
            'gym' => $gym
        ]);
    }

    function getGymRouteView($route_id)
    {
        $GymRoute = GymRoute::class;
        $Gym = Gym::class;
        $Room = GymRoom::class;
        $Cross = IndoorCross::class;

        $gymRoute = $GymRoute::where('id', $route_id)->with('sector')->first();
        $room = $Room::find($gymRoute->sector->room_id);
        $gym = $Gym::find($room->gym_id);

        $user_crosses = $Cross::where([['user_id', '=', Auth::id()], ['route_id', '=', $route_id]])->get();

        return view('pages.gym.vues.routeVue', [
            'route' => $gymRoute,
            'user_crosses' => $user_crosses,
            'gym' => $gym,
            'room' => $room,
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
