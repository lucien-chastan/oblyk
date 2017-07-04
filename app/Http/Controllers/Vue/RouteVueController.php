<?php

namespace App\Http\Controllers\Vue;

use App\Http\Controllers\Controller;
use App\Route;

class RouteVueController extends Controller
{
    function vueRoute($id){
        $data = ['route' => Route::where('id',$id)
            ->with('routeSections')
            ->withCount('photos')
            ->with('crag')
            ->with('sector')
            ->first()];
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
        $data = ['route' => Route::where('id',$id)->first()];
        return view('pages.route.vues.videosVue', $data);
    }
}