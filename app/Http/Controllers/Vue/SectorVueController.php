<?php

namespace App\Http\Controllers\Vue;

use App\Http\Controllers\Controller;
use App\Route;
use App\Sector;
use Illuminate\Support\Facades\Auth;

class SectorVueController extends Controller
{
    function vueRoutes($id){

        $getRoutes = Route::where('sector_id',$id)
            ->with('routeSections')
            ->with('climb')
            ->with('tickLists')
            ->withCount('descriptions')
            ->withCount('photos')
            ->withCount('videos')
            ->orderBy('label')
            ->get();

        //on fait la liste des routes
        $tickRoutes = Route::where('sector_id',$id)->whereHas('tickLists', function ($query) {$query->where('user_id', '=', Auth::id());})->get();

        //on parcours la liste des routes et on regarde si elles sont dans la site des routes tickée
        $routes = [];
        foreach ($getRoutes as $route){
            foreach ($tickRoutes as $tick){
                if($tick->id == $route->id){
                    $route->ticked = true;
                }
            }
            $routes[] = $route;
        }

        $data = [
            "routes" => $routes,
            "sector" => Sector::where('id', $id)->first()
        ];

        return view('pages.crag.vues.sector-vues.sectorLinesVue', $data);
    }

    function vueDescriptions($id){

        $data = [
            'sector' => Sector::where('id',$id)->with('descriptions.user')->first()
        ];

        return view('pages.crag.vues.sector-vues.sectorDescriptionsVue', $data);
    }

    function vuePhotos($id){

        $data = [
            'sector' => Sector::where('id',$id)->with('photos')->first()
        ];

        return view('pages.crag.vues.sector-vues.sectorPhotosVue', $data);
    }
}