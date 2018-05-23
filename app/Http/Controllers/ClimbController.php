<?php

namespace App\Http\Controllers;

use App\Climb;

class ClimbController extends Controller
{
    function index(){
        return response()->json(Climb::select('id')->get()
            ->each(function($e) {
                $e->label = __("elements/climbs.climb_" . $e->id);
            })
        );
    }
}
