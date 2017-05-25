<?php

namespace App\Http\Controllers\Vue;

use App\Crag;
use App\Orientation;
use App\Season;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CragVueController extends Controller
{
    function vueMap($id){
        $data = ['crag' => Crag::where('id',$id)->with('parkings')->first()];
        return view('pages.crag.vues.mapVue', $data);
    }

    function vueFilActu($id){
        return view('pages.crag.vues.filActuVue');
    }

    function vueMedias($id){
        return view('pages.crag.vues.mediasVue');
    }

    function vueLiens($id){
        $data = [
            'crag' => Crag::where('id',$id)->with('links.user')->first()
        ];
        return view('pages.crag.vues.liensVue', $data);
    }

    function vueTopos($id){
        return view('pages.crag.vues.toposVue');
    }

    function vueSecteur($id){
        $data = [
            'crag' => Crag::where('id',$id)->with('sectors.sun')->with('sectors.rain')->with('sectors.orientation')->first()
        ];
        return view('pages.crag.vues.secteurVue', $data);
    }
}