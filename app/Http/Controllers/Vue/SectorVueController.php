<?php

namespace App\Http\Controllers\Vue;

use App\Http\Controllers\Controller;
use App\Sector;

class SectorVueController extends Controller
{
    function vueLines($id){
        return view('pages.crag.vues.sector-vues.sectorLinesVue');
    }

    function vueDescriptions($id){

        $data = [
            'sector' => Sector::where('id',$id)->with('descriptions.user')->first()
        ];

        return view('pages.crag.vues.sector-vues.sectorDescriptionsVue', $data);
    }

    function vuePhotos($id){
        return view('pages.crag.vues.sector-vues.sectorPhotosVue');
    }
}