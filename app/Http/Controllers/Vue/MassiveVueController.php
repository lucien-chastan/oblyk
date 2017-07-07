<?php

namespace App\Http\Controllers\Vue;

use App\Massive;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MassiveVueController extends Controller
{

    function vueFilActu($id){
        return view('pages.massive.vues.filActuVue');
    }

    function vueLiens($id){
        $data = [
            'massive' => Massive::where('id',$id)->with('links.user')->first()
        ];
        return view('pages.massive.vues.liensVue', $data);
    }

    function vueSites($id){
        $data = [
            'massive' => Massive::where('id',$id)->with('crags.crag.rock')->first()
        ];
        return view('pages.massive.vues.sitesVue', $data);
    }

}