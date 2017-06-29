<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    function similarRoute(Request $request){

        $similarLabel = Route::similarRoute($request->input('crag_id'), $request->input('route_id') , $request->input('label'));

        return response()->json(json_encode($similarLabel));
    }
}
