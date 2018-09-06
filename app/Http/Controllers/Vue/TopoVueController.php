<?php

namespace App\Http\Controllers\Vue;

use App\Topo;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopoVueController extends Controller
{

    function vueFilActu($id){
        $data = [
            'topo' => Topo::where('id',$id)->first()
        ];
        return view('pages.topo.vues.filActuVue', $data);
    }

    function vueLiens($id){
        $data = [
            'topo' => Topo::where('id',$id)->with('links.user')->first()
        ];
        return view('pages.topo.vues.liensVue', $data);
    }

    function vueSites($id){
        $data = [
            'topo' => Topo::where('id',$id)->with('crags.crag.rock')->first()
        ];
        return view('pages.topo.vues.sitesVue', $data);
    }

    function vueAcheter($id){
        $topo = Topo::where('id',$id)->with('sales.user')->first();

        return view('pages.topo.vues.acheterVue', [
            'topo' => $topo,
            'data_vc' => $topo->getVieuxCampeurInformation()
        ]);
    }

    function vueMap($id){
        $data = [
            'topo' => Topo::where('id',$id)->first()
        ];
        return view('pages.topo.vues.mapVue', $data);
    }
}