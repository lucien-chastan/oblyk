<?php

namespace App\Http\Controllers\Vue;

use App\Http\Controllers\Controller;
use App\Route;
use App\Sector;

class SectorVueController extends Controller
{
    function vueRoutes($id){
        $data = [
            "routes" => Route::where('sector_id',$id)->with('routeSections')->with('climb')->orderBy('label')->get(),
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