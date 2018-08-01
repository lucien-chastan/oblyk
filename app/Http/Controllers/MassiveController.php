<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Follow;
use App\Massive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MassiveController extends Controller
{
    function massivePage($massive_id, $massive_title){

        $massive = Massive::where('id', $massive_id)
            ->with('descriptions')
            ->withCount('links')
            ->withCount('crags')
            ->withCount('posts')
            ->withCount('versions')
            ->first();

        // Si le label à changé alors on redirige
        if(Massive::webUrl($massive_id, $massive_title) != $massive->url()) {
            return $this->massiveRedirectionPage($massive_id);
        }

        //on va chercher si l'utilisateur follow ce regroupement
        $userFollow = Follow::where(
            [
                ['user_id', '=', Auth::id()],
                ['followed_type', '=', 'App\Massive'],
                ['followed_id', '=', $massive->id]
            ]
        )->first();
        $userFollow = (isset($userFollow)) ? 'true' : 'false';

        $massive->views++;
        $massive->save();

        $objRegions = Massive::distincRegions($massive->id);
        $regions = [];
        foreach ($objRegions as $region) $regions[] = $region->region;

        $data = [
            'massive' => $massive,
            'regions' => $regions,
            'meta_title' => $massive['label'],
            'meta_description' => 'description de ' . $massive['label'],
            'user_follow' => $userFollow
        ];

        return view('pages.massive.massive', $data);
    }

    //RETOURNE LES MASSIFS DANS UN RAYON AUTOUR D'UN POINT DONNÉE
    public function getMassivesArroundPoint($lat, $lng, $rayon, $crag_id){

        //on liste les massives du site pour les exclures de la recherche par la suite
        $cragMassives = Crag::where('id',$crag_id)->with('massives')->first();
        $arrayMassives = [];
        foreach ($cragMassives->massives as $liaison){
            $arrayMassives[] = $liaison->massive_id;
        }

        $notIn = count($arrayMassives) > 0 ? ' AND massives.id NOT IN(' . implode(',', $arrayMassives) . ')' : '';

        $massivesInRayon = DB::select('
            SELECT DISTINCT massives.id AS id
            FROM massives INNER JOIN massive_crags ON massives.id = massive_crags.massive_id
            INNER JOIN crags ON massive_crags.crag_id = crags.id
            WHERE getRange(crags.lat, crags.lng, :lat, :lng) <= :rayon' . $notIn,
            [
                'lat' => $lat,
                'lng' => $lng,
                'rayon' => $rayon * 1000
            ]
        );

        $massives = [];
        foreach ($massivesInRayon as $massive) $massives[] = $massive->id;
        $data = ['massives' => Massive::whereIn('id',$massives)->get(), 'rayon' => $rayon];

        return view('pages.crag.partials.liste-massives', $data);

    }

    public function massiveRedirectionPage($massive_id) {
        $massive = Massive::find($massive_id);
        return redirect($massive->url(),301);
    }

}
