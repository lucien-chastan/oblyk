<?php

namespace App\Http\Controllers\Vue;

use App\Crag;
use App\Topo;
use App\TopoCrag;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopoVueController extends Controller
{

    function vueFilActu($id){
        $topo = Topo::class;
        $data = [
            'topo' => $topo::where('id',$id)->first()
        ];
        return view('pages.topo.vues.filActuVue', $data);
    }

    function vueLiens($id){
        $topo = Topo::class;
        $data = [
            'topo' => $topo::where('id',$id)->with('links.user')->first()
        ];
        return view('pages.topo.vues.liensVue', $data);
    }

    function vueSites($id){
        $topo = Topo::class;
        $data = [
            'topo' => $topo::where('id',$id)
                ->with('crags.crag.rock')
                ->with('crags.crag.gapGrade')
                ->with('crags.crag.routes')
                ->first()
        ];
        return view('pages.topo.vues.sitesVue', $data);
    }

    function vueAcheter($id){
        $topo = Topo::class;
        $topo = $topo::where('id',$id)->with('sales.user')->first();

        return view('pages.topo.vues.acheterVue', [
            'topo' => $topo,
            'data_vc' => $topo->getVieuxCampeurInformation()
        ]);
    }

    function vueMap($id){
        $topo = Topo::class;
        $data = [
            'topo' => $topo::where('id',$id)->first()
        ];
        return view('pages.topo.vues.mapVue', $data);
    }

    function vuePhoto($id){
        $crags = [];
        $topo = Topo::class;
        $topo = $topo::where('id',$id)->with('crags')->with('crags.crag')->first();

        foreach ($topo->crags as $crag) {
            $cragPhotos = $crag->crag->AllPhoto();
            if(count($cragPhotos) > 0) {
                $crags[] = $crag->crag;
            }
        }

        return view('pages.topo.vues.photoVue', [
            'topo' => $topo,
            'crags' => $crags
        ]);
    }
}
