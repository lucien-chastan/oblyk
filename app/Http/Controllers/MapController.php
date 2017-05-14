<?php

namespace App\Http\Controllers;

use App\Crag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function mapPage(){
        $data = [
            'crags' => Crag::get(),
            'meta_title' => 'Carte des falaises',
            'meta_description' => 'Voir la carte interactive des sites naturels de grimpe et des salles d\'escalade sur Oblyk, que ce soit en France, ou dans le Monde, et voir leurs informations détaillées'
        ];

        return view('pages.map.map', $data);
    }

    //retourne les falaises dans un rayon autour d'un point donnée
    public function getPopupMarkerAroundPoint($lat, $lng, $rayon){

        $cragsInRayon = Crag::getCragsAroundPoint($lat, $lng, $rayon);
        $crags = [];
        foreach ($cragsInRayon as $crag) $crags[] = $crag->id;
        $data = ['crags' => Crag::whereIn('id',$crags)->with('parkings')->get()];

        return response()->json($data);

    }
}
