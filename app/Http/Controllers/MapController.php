<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Climb;
use App\Gym;
use App\Massive;
use App\Topo;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function mapPage(){
        $data = [
            'crags' => Crag::withCount('routes')->with('gapGrade')->get(),
            'gyms' => Gym::get(),
            'meta_title' => 'Carte des falaises et salle d\'escalade',
            'meta_description' => 'Voir la carte interactive des sites naturels de grimpe et des salles d\'escalade sur Oblyk, que ce soit en France, ou dans le Monde, et voir leurs informations détaillées'
        ];

        return view('pages.map.map', $data);
    }
    public function filterMap(Request $request) {
        $all_climb_types = Cache::remember('climb_types', 666, function() {
            return Climb::select('label')->pluck('label');
        });

        $data = [
            'crags' => Crag::withCount('routes')
            ->with('gapGrade')
            ->whereExists(function ($q) use ($request, $all_climb_types) {
                $q->select(DB::raw(1))
                    ->from('routes')
                    ->join('climbs', 'climbs.id', 'routes.climb_id')
                    ->whereIn('climbs.label', $request->input('climb_type', $all_climb_types))
                    ->whereRaw('routes.crag_id = crags.id');
            })
            ->get(),
        ];
        return response()->json(['data' => $data, 'request' => $request->all()]);
        /*
         * type_voie    1
         * type_grande_voie 1
         * type_bloc    1
         * type_deep_water  0
         * type_via_ferrata 0
         * gap_grade    
         * id   2
         * spreadable_id    1
         * spreadable_type  "App\\Crag"
         * min_grade_val    25
         * max_grade_val    41
         */
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
