<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    function mapPage(){

        $data = [
            'meta_title' => 'Carte des Grimpeurs, Trouver un partenaire d\'escalade',
            'meta_description' => 'Carte des Grimpeurs, Trouver un partenaire d\'escalade',
        ];

        return view('pages.partenaire.partenaireMap', $data);
    }

}
