<?php

namespace App\Http\Controllers\CRUD;

use App\Contest;
use App\ContestRoute;
use App\ContestUser;
use App\Gym;
use App\GymRoom;
use App\GymRoute;
use App\GymSector;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ContestRouteController extends Controller
{
    // Display edit/create popup
    function contestRouteModal(Request $request)
    {
        $gym = Gym::find($request->input('gym_id'));
        $contest = Contest::find($request->input('contest_id'));

        $selectedRoutes = ContestRoute::where('contest_id', $contest->id)->select('route_id')->get();
        $rooms = GymRoom::where('gym_id', $gym->id)->select('id')->get();
        $sectors = GymSector::whereIn('room_id', $rooms->toArray())->select('id')->get();

        $selectedArrayRoutes = [];
        foreach ($selectedRoutes as $route) {
            $selectedArrayRoutes[] = $route->route_id;
        }

        $routes = GymRoute::where('dismounted_at', null)
            ->whereIn('sector_id', $sectors->toArray())
            ->with('sector')
            ->with('sector.room')
            ->get();

        $data = [
            'dataModal' => [
                'routes' => $routes,
                'contest_id' => $request->input('contest_id'),
                'contest' => $contest,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'callback' => $request->input('callback'),
                'selectedRoutes' => $selectedArrayRoutes
            ]
        ];

        return view('modal.contest-route', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        // Purge all old contest route
        ContestRoute::where('contest_id', $request->input('contest_id'))->delete();

        // Add new route
        $contest = Contest::find($request->input('contest_id'));
        $newContestRoutes = $request->input('contestRoutes');
        if(isset($newContestRoutes)) {
            foreach ($newContestRoutes as $routeId) {
                $contestRoute = new ContestRoute();
                $contestRoute->route_id = $routeId;
                $contestRoute->contest_id = $contest->id;
                $contestRoute->save();
            }
        }

        return redirect($contest->url());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $contestUser = ContestUser::find($id);
        $contestUser->delete();
        return response()->json(json_encode($contestUser));
    }
}
