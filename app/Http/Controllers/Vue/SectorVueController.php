<?php

namespace App\Http\Controllers\Vue;

use App\Http\Controllers\Controller;
use App\Route;
use App\Sector;
use DebugBar;
use Illuminate\Support\Facades\Auth;

class SectorVueController extends Controller
{
    function vueRoutes($id){

        $authId = Auth::id();

        $routes = Route::where('sector_id',$id)
            ->with('routeSections')
            ->with('climb')
            ->with(['tickLists' => function ($query) use ($authId) {$query->where('user_id', $authId);}])
            ->with(['crosses' => function ($query) use ($authId) {$query->where('user_id', $authId);}])
            ->withCount('descriptions')
            ->withCount('photos')
            ->withCount('videos')
            ->orderBy('label')
            ->get();

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