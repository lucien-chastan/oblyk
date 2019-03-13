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
    function schemePage($gym_id, $room_id, $gym_label)
    {
        $Gym = Gym::class;
        $GymRoom = GymRoom::class;

        $gym = $Gym::where('id', $gym_id)->with('rooms')->withCount('rooms')->first();
        $room = $GymRoom::find($room_id);
        $rooms = $GymRoom::where('gym_id', $gym_id)->orderBy('order')->get();

        if ($gym->id != $room->gym_id) return redirect($gym->url());

        // If gym room name is not a good name, then redirection
        if(GymRoom::webUrl($room_id, $gym_id, $gym_label) != $room->url()) {
            return $this->gymRoomRedirectionPage($room_id);
        }

        $bannerRGBA = HelpersTemplates::hexToRgb(
            $room->banner_bg_color ?? config('app.room_banner_bg_color'),
            $room->banner_opacity ?? config('app.room_banner_opacity')
        );

        $colors = [
            'bgSchemeColor' => $room->scheme_bg_color ?? config('app.room_scheme_bg_color'),
            'bannerColor' => $room->banner_color ?? config('app.room_banner_color'),
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

        $room = $Room::where('id',$room_id)
            ->with(['crosses' => function($query) use ($room_id) {$query->where([['user_id', Auth::id()],['room_id', $room_id]]);}])
            ->first();

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
            ->orderBy('group_sector', 'ASC')
            ->orderBy('label', 'ASC')
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

        $gymSector = $GymSector::where('id', $sector_id)
            ->with('room')
            ->first();

        $gymRoutes = $GymRoute::where([['sector_id', $gymSector->id], ['dismounted_at', null]])
            ->with(['crosses' => function($query) use ($gymSector) {$query->where([['user_id', Auth::id()],['sector_id', $gymSector->id]]);}])
            ->withCount('descriptions')
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

        $gymRoute = $GymRoute::where('id', $route_id)
            ->with('sector')
            ->with('descriptions')
            ->first();

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

    function getGymCrossesView($gymId) {
        $Gym = Gym::class;
        $Cross = IndoorCross::class;

        $gym = $Gym::find($gymId);
        $crosses = $Cross::where([['user_id', Auth::id()], ['gym_id', $gym->id]])
            ->with('gym')
            ->with('room')
            ->with('room.gym')
            ->with('sector')
            ->with('route')
            ->orderBy('release_at', 'DESC')
            ->get();

        $sumCrossesHeight = $Cross::where([['user_id', Auth::id()], ['gym_id', $gym->id]])
            ->sum('height');

        $maxGradCrosse = $Cross::where([['user_id', Auth::id()], ['gym_id', $gym->id], ['status_id', '!=', 1]])
            ->max('grade_val');

        return view('pages.gym.vues.crossesVue', [
            'crosses' => $crosses,
            'sum_height' => $sumCrossesHeight,
            'max_grad' => $maxGradCrosse,
            'gym' => $gym,
        ]);
    }

    function getGymSectors($room_id)
    {
        $sectors = GymSector::where([['room_id', '=', $room_id], ['area', '!=', null]])->get();
        return response()->json(['sectors' => $sectors]);
    }

    function getGymRoutes($room_id)
    {
        $routes = [];
        $sectors = GymSector::where('room_id', '=', $room_id)
            ->with(['routes' => function($query) {$query->where([['line', '!=', ''],['dismounted_at', null]]);}])
            ->get();

        foreach ($sectors as $sector) {
            foreach ($sector->routes as $route) {
                $route->line_color = $route->hold_colors()[0];
                $routes[] = $route;
            }
        }

        return response()->json(['routes' => $routes]);
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

    public function gymRoomRedirectionPage($room_id) {
        $Room = GymRoom::class;
        $room = $Room::find($room_id);
        return redirect($room->url(),301);
    }
}
