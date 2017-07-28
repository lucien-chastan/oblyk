<?php

namespace App\Http\Controllers\Vue;

use App\Gym;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GymVueController extends Controller
{
    function vueMap($id){
        $data = ['gym' => Gym::where('id',$id)->first()];
        return view('pages.gym.vues.mapVue', $data);
    }

    function vueFilActu($id){
        $data = [
            'gym' => Gym::where('id', $id)->first()
        ];
        return view('pages.gym.vues.filActuVue',$data);
    }
}