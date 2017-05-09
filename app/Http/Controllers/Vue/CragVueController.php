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
    //affiche la vue de la map
    function vueMap($id){

        return view('pages.crag.vues.mapVue');
    }
}