<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function mapPage(){
        $data = [
            'meta_title' => 'Carte des falaises',
            'meta_description' => 'Voir la carte interactive des sites naturels de grimpe et des salles d\'escalade sur Oblyk, que ce soit en France, ou dans le Monde, et voir leurs informations détaillées'
        ];

        return view('pages.map.map', $data);
    }
}
