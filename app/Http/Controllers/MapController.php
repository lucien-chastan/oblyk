<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Gym;
use App\Massive;
use App\Topo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function mapPage(Request $request){
        $crags = Crag::withCount('routes')
            ->with('gapGrade');

        $this->filter_by_type($request, $crags);

        $crags = $crags->get();

        $data = [
            'crags' => $crags,
            'gyms' => Gym::get(),
            'meta_title' => 'Carte des falaises et salle d\'escalade',
            'meta_description' => 'Voir la carte interactive des sites naturels de grimpe et des salles d\'escalade sur Oblyk, que ce soit en France, ou dans le Monde, et voir leurs informations détaillées'
        ];

        return view('pages.map.map', $data);
    }
    private function filter_by_type($request, $crags) {
        if ($request->has('crag_type')) {
            switch($request->input('crag_type')) {
                //enumerate to block sqli
                case "bloc":
                    $crags->where('type_bloc', '=', true);
                    break;
                case "voie":
                    $crags->where('type_voie', '=', true);
                    break;
                case "grande_voie":
                    $crags->where('type_grande_voie', '=', true);
                    break;
                case "deep_water":
                    $crags->where('type_deep_water', '=', true);
                    break;
                case "via_ferrata":
                    $crags->where('type_via_ferrata', '=', true);
                    break;
            }
        }
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
