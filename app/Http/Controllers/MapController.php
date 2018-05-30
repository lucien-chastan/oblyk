<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Climb;
use App\Gym;
use App\Massive;
use App\Topo;
use App\Route;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function mapPage(){
        $data = [
            'climb_types' => Climb::select('id')->get()
                ->each(function($e) {
                    $e->label = __("elements/climbs.climb_" . $e->id);
                }),
            'crags' => Crag::withCount('routes')->with('gapGrade')->get(),
            'gyms' => Gym::get()
        ];

        return view('pages.map.map', $data);
    }

    public function filterMap(Request $request) {
        $all_climb_types = Cache::rememberForever('climb_types', function() {
            return Climb::select('id')->pluck('id');
        });

        $data = Cache::remember('search_map_'.serialize($request->all()), 360, function() use ($request, $all_climb_types) {
            $data = [
                'crags' => Crag::withCount('routes')
                ->with('gapGrade')
                ->whereExists(function ($q) use ($request, $all_climb_types) {

                    $grade_from = Route::gradeToVal($request->input('range_from', '1a'), '');
                    $grade_to = Route::gradeToVal($request->input('range_to', '9c'), '') + 1;

                    $q->select(DB::raw(1))
                        ->from('routes')
                        ->join('route_sections', 'route_sections.route_id', '=', 'routes.id')
                        ->whereIn('routes.climb_id', $request->input('climb_type', $all_climb_types))
                        ->whereRaw('routes.crag_id = crags.id')
                        ->whereBetween('grade_val', [$grade_from, $grade_to]);
                })
                ->get(),
            ];
            return $data;
        });

        // include climbing gym if toogle gym is checked
        $data['gyms'] = (in_array('gym',$request->input('climb_type'))) ? Gym::get() : [];

        return response()->json(['data' => $data, 'request' => $request->all()]);
    }

    public function gymPage(){
        $data = [
            'gyms' => Gym::get()
        ];

        return view('pages.map.map-gym', $data);
    }

    //RETOURNE LES FALAISES DANS UN RAYON AUTOUR D'UN POINT DONNÉE
    public function getPopupMarkerAroundPoint($lat, $lng, $rayon){

        $cragsInRayon = Crag::getCragsAroundPoint($lat, $lng, $rayon);
        $crags = [];
        foreach ($cragsInRayon as $crag) $crags[] = $crag->id;
        $data = [
            'crags' => Crag::whereIn('id',$crags)
                ->withCount('routes')
                ->with('gapGrade')
                ->with('parkings')
                ->with('approaches')
                ->with('sectors')
                ->with('sectors.gapGrade')
                ->get()
        ];

        return response()->json($data);

    }

    //RETOURNE LES SITES D'ESCALADE D'UN TOPO
    public function getPopupMarkerCragsTopo($topo_id){
        $data = [];
        $cragsTopo = Topo::where('id',$topo_id)->with('crags.crag')->with('crags.crag.gapGrade')->with('crags.crag.routes')->first();
        foreach ($cragsTopo->crags as $liaison) {
            $crag = $liaison->crag;
            $crag->routes_count = count($crag->routes);
            $data[] = $liaison->crag;
        }

        return response()->json($data);
    }


    //RETOURNE LES SITES D'ESCALADE D'UN GROUPEMENT DE SITE
    public function getPopupMarkerCragsMassive($massive_id){
        $data = [];
        $cragsMassive = Massive::where('id',$massive_id)->with('crags.crag')->with('crags.crag.gapGrade')->with('crags.crag.routes')->first();
        foreach ($cragsMassive->crags as $liaison) {
            $crag = $liaison->crag;
            $crag->routes_count = count($crag->routes);
            $data[] = $crag;
        }

        return response()->json($data);
    }


    //RETOURNE LES POINTS DE VENTE D'UN TOPO
    public function getPopupMarkerSalesTopo($topo_id){
        $data = [];
        $salesTopo = Topo::where('id',$topo_id)->with('sales')->first();
        $data = $salesTopo->sales;

        return response()->json($data);
    }
}
