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
        $data = [
            'route' => Route::where('id',$id)
                ->with('descriptions')
                ->with('tags')
                ->with('descriptions.user')
                ->with('routeSections')
                ->with('routeSections.anchor')
                ->with('routeSections.point')
                ->with('routeSections.incline')
                ->with('routeSections.reception')
                ->with('routeSections.start')
                ->first()
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