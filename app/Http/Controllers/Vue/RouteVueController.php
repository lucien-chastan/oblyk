<?php

namespace App\Http\Controllers\Vue;

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

        $count_carnet = 0;
        if(isset($tickList)) $count_carnet = 1;

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

        $route = Route::where('id',$id)->first();
        $tickList = TickList::where([['route_id', $route->id],['user_id',Auth::id()]])->first();

        $data = [
            'route' => $route,
            'ticklist'=>$tickList
        ];

        return view('pages.route.vues.carnetVue', $data);
    }
}