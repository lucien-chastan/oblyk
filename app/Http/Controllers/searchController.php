<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Word;
use Illuminate\Http\Request;

class searchController extends Controller
{
    //CONTROLLER DES PETITES PAGES LIÉES AU PROJET, TELLE QUE "QUI SOMME NOUS", "LE PORJET", "MENTIONS LÉGALE", ETC.
    public function search($search){


        //RECHERCHE SUR LES FALAISES
        $crags = [];
        $findCrags = Crag::where('label', 'like', '%' . $search . '%')->get();
        foreach ($findCrags as $crag){
            $crag->url = route('cragPage', ['crag_id'=>$crag->id, 'crag_label'=>str_slug($crag->label)]);
            $crags[] = $crag;
        }

        //RECHERCHE SUR LES MOTS DU LEXIQUE
        $words = Word::where('label', 'like', '%' . $search . '%')->get();

        $data = [
            'search' => $search,
            'nombre' => [
                'crags' => count($crags),
                'words' => count($words),
            ],
            'crags' => $crags,
            'words' => $words,
        ];

        return response()->json($data);
    }

}
