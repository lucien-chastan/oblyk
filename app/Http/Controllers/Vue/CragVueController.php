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
        $data = ['crag' => Crag::where('id',$id)->first()];
        return view('pages.crag.vues.mapVue', $data);
    }

    function vueFilActu($id){
        return view('pages.crag.vues.filActuVue');
    }

    function vueMedias($id){
        return view('pages.crag.vues.mediasVue');
    }

    function vueLiens($id){
        return view('pages.crag.vues.liensVue');
    }

    function vueTopos($id){
        return view('pages.crag.vues.toposVue');
    }
}