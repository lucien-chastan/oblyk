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
    public function mapPage(){
        $data = [
            'crags' => Crag::withCount('routes')->with('gapGrade')->get(),
            'gyms' => Gym::get(),
            'meta_title' => 'Carte des falaises et salle d\'escalade',
            'meta_description' => 'Voir la carte interactive des sites naturels de grimpe et des salles d\'escalade sur Oblyk, que ce soit en France, ou dans le Monde, et voir leurs informations détaillées'
        ];

        return view('pages.map.map', $data);
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
        $cragsTopo = Topo::where('id',$topo_id)->with('crags.crag')->first();
        foreach ($cragsTopo->crags as $liaison) $data[] = $liaison->crag;

        return response()->json($data);
    }


    //RETOURNE LES SITES D'ESCALADE D'UN GROUPEMENT DE SITE
    public function getPopupMarkerCragsMassive($massive_id){
        $data = [];
        $cragsMassive = Massive::where('id',$massive_id)->with('crags.crag')->first();
        foreach ($cragsMassive->crags as $liaison) $data[] = $liaison->crag;

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
