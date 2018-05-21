<?php

namespace App\Http\Controllers;

use App\Climb;

class ClimbController extends Controller
{
    function index(){
        return response()->json(Climb::select('label')->get());
    }
}
