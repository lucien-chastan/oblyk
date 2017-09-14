<?php

namespace App\Http\Controllers\Vue;

use App\Cross;
use App\Http\Controllers\Controller;
use App\Route;
use App\TickList;
use Illuminate\Support\Facades\Auth;

class RouteVueController extends Controller
{
    function vueRoute($id){

        $route = Route::where('id',$id)
            ->with('routeSections')
            ->withCount('photos')
            ->withCount('videos')
            ->with('crag')
            ->with('sector')
            ->first();

        //route dans la ticklist du connecté
        $tickList = TickList::where([['route_id', $route->id],['user_id',Auth::id()]])->first();

        $crosses = Cross::where([['route_id',$route->id],['user_id', Auth::id()]])->get();

        $count_carnet = count($crosses);
        if(isset($tickList)) $count_carnet++;

        $route->views++;
        $route->save();

        $data = [
            'route' => $route,
            'ticklist' => $tickList,
            'count_carnet' => $count_carnet
        ];

        return view('pages.route.vues.route', $data);
    }


    function vueInformation($id){

        $route = Route::where('id',$id)
            ->with('descriptions')
            ->with('tags')
            ->with('descriptions.user')
            ->with('routeSections')
            ->with('routeSections.anchor')
            ->with('routeSections.point')
            ->with('routeSections.incline')
            ->with('routeSections.reception')
            ->with('routeSections.start')
            ->first();

        //calcul de la durté de la cotation
        $easy = $just = $hard = $sum = 0;
        $crosses = Cross::where('route_id',$route->id)
            ->where('hardness_id','!=',1)
            ->get();

        foreach ($crosses as $cross){
            if($cross->hardness_id == 2) $easy++;
            if($cross->hardness_id == 3) $just++;
            if($cross->hardness_id == 4) $hard++;
            $sum += $cross->hardness_id;
        }

        $hardness = [
            'easy' => $easy / count($crosses) * 100,
            'just' => $just / count($crosses) * 100,
            'hard' => $hard / count($crosses) * 100,
            'trend' => round($sum / count($crosses),0),
            'nbVote' => count($crosses),
        ];

        $data = [
            'machin' => 'coucou',
            'route' => $route,
        ];

        return view('pages.route.vues.informationVue', $data);
    }

    function vueComments($id){
        $data = ['route' => Route::where('id',$id)->first()];
        return view('pages.route.vues.commentsVue', $data);
    }

    function vuePhotos($id){
        $data = ['route' => Route::where('id',$id)->with('photos')->first()];
        return view('pages.route.vues.photosVue', $data);
    }

    function vueVideos($id){
        $data = ['route' => Route::where('id',$id)->with('videos')->first()];
        return view('pages.route.vues.videosVue', $data);
    }

    function vueCarnet($id){

        $route = Route::where('id',$id)->withCount('routeSections')->first();
        $tickList = TickList::where([['route_id', $route->id],['user_id',Auth::id()]])->first();
        $crosses = Cross::where([['route_id',$route->id],['user_id', Auth::id()]])
            ->with('crossSections')
            ->with('crossSections.routeSection')
            ->with('crossUsers.user')
            ->with('crossHardness')
            ->with('crossMode')
            ->with('description')
            ->with('crossStatus')
            ->orderBy('release_at', 'DESC')
            ->get();

        $data = [
            'route' => $route,
            'ticklist'=>$tickList,
            'crosses'=>$crosses
        ];

        return view('pages.route.vues.carnetVue', $data);
    }
}