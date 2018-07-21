<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Follow;
use App\Topo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TomLingham\Searchy\Facades\Searchy;

class TopoController extends Controller
{
    function topoPage($topo_id, $topo_title){

        $topo = Topo::where('id', $topo_id)
            ->with('descriptions')
            ->withCount('links')
            ->withCount('crags')
            ->withCount('posts')
            ->withCount('sales')
            ->withCount('versions')
            ->with('articleTopos.article')
            ->first();

        //on va chercher si l'utilisateur follow ce topo
        $userFollow = Follow::where(
            [
                ['user_id', '=', Auth::id()],
                ['followed_type', '=', 'App\Topo'],
                ['followed_id', '=', $topo->id]
            ]
        )->first();
        $userFollow = (isset($userFollow)) ? 'true' : 'false';

        $topo->views++;
        $topo->save();

        $data = [
            'topo' => $topo,
            'meta_title' => $topo['label'],
            'meta_description' => 'description de ' . $topo['label'],
            'user_follow' => $userFollow
        ];

        return view('pages.topo.topo', $data);
    }

    //RETOURNE LES TOPOS DANS UN RAYON AUTOUR D'UN POINT DONNÉE
    public function getToposArroundPoint($lat, $lng, $rayon, $crag_id){

        //on liste les topos du site pour les exclures de la recherche par la suite
        $cragTopos = Crag::where('id',$crag_id)->with('topos')->first();
        $arrayTopos = [];
        foreach ($cragTopos->topos as $liaison){
            $arrayTopos[] = $liaison->topo_id;
        }

        $notIn = count($arrayTopos) > 0 ? ' AND topos.id NOT IN(' . implode(',', $arrayTopos) . ')' : '';

        $toposInRayon = DB::select('
            SELECT DISTINCT topos.id AS id 
            FROM topos INNER JOIN topo_crags ON topos.id = topo_crags.topo_id 
            INNER JOIN crags ON topo_crags.crag_id = crags.id 
            WHERE getRange(crags.lat, crags.lng, :lat, :lng) <= :rayon' . $notIn,
            [
                'lat' => $lat,
                'lng' => $lng,
                'rayon' => $rayon * 1000
            ]
        );

        $topos = [];
        foreach ($toposInRayon as $topo) $topos[] = $topo->id;
        $data = ['topos' => Topo::whereIn('id',$topos)->get(), 'rayon' => $rayon];

        return view('pages.crag.partials.liste-topos', $data);
    }

    public function getToposByName($crag_id, $name){

        $topo_ids = Crag::where('crags.id',$crag_id)
            ->with('topos')
            ->get()
            ->pluck('topos')
            ->collapse()
            ->pluck('topo_id');

        $topos = Searchy::search('topos')->fields('label')->query($name)->getQuery()->whereNotIn('id', $topo_ids)->limit(20)->get();

        $data = ['topos' => $topos];

        return view('pages.crag.partials.liste-topos-search', $data);
    }
}
