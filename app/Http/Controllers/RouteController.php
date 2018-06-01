<?php

namespace App\Http\Controllers;

use App\Cross;
use App\Route;
use App\RouteSection;
use App\TickList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cache;

class RouteController extends Controller
{
    function similarRoute(Request $request){

        $similarLabel = Route::similarRoute($request->input('crag_id'), $request->input('route_id') , $request->input('label'));

        return response()->json(json_encode($similarLabel));
    }

    public function routeGrades(){
        $grades_calc = Cache::remember('grades_transformer', 66666, function() {
            $grades_calc = [];
            for($i=1; $i<=54; $i++) {
                array_push($grades_calc, ['grade' => Route::valToGrad($i), 'grade_val' => $i]);
            }
            return $grades_calc;
        });
        return response()->json($grades_calc);
    }
    public function routePage($route_id, $route_label){

        $route = Route::where('id', $route_id)
            ->with(['descriptions' =>function ($query) {$query->where('description','!=','');}])
            ->with('tags')
            ->with('descriptions.user')
            ->with('routeSections')
            ->with('routeSections.anchor')
            ->with('routeSections.point')
            ->with('routeSections.incline')
            ->with('routeSections.reception')
            ->with('routeSections.start')
            ->withCount('photos')
            ->withCount('videos')
            ->withCount('versions')
            ->first();

        //route dans la ticklist du connecté
        $tickList = TickList::where([['route_id', $route->id],['user_id',Auth::id()]])->first();

        $crosses = Cross::where([['route_id',$route->id],['user_id', Auth::id()]])->get();

        $count_carnet = count($crosses);
        if(isset($tickList)) $count_carnet++;

        $route->views++;
        $route->save();

        //calcul de la durté de la cotation
        $easy = $just = $hard = $sum = 0;
        $crosses = Cross::where('route_id',$route->id)
            ->where('hardness_id','!=',1)
            ->get();

        foreach ($crosses as $cross){
            if($cross->hardness_id == 2) $easy++;
            if($cross->hardness_id == 3) $just++;
            if($cross->hardness_id == 4) $hard++;
            $sum += $cross->hardness_id;
        }

        $hardness = [
            'easy' => (count($crosses) > 0) ? round($easy / count($crosses) * 100, 1) : 0,
            'just' => (count($crosses) > 0) ? round($just / count($crosses) * 100, 1) : 0,
            'hard' => (count($crosses) > 0) ? round($hard / count($crosses) * 100, 1) : 0,
            'trend' => (count($crosses) > 0) ? round($sum / count($crosses),0) : 0,
            'nbVote' => count($crosses),
        ];

        $data = [
            'route'=>$route,
            'hardness'=> $hardness,
            'ticklist' => $tickList,
            'count_carnet' => $count_carnet
        ];

        return view('pages.route.line', $data);
    }
}
