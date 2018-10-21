<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Follow;
use App\Topo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TomLingham\Searchy\Facades\Searchy;

class TopoController extends Controller
{
    function topoPage($topo_id, $topo_title){

        $topo = Topo::class;
        $topo = $topo::where('id', $topo_id)
            ->with('descriptions')
            ->withCount('links')
            ->withCount('crags')
            ->withCount('posts')
            ->withCount('sales')
            ->withCount('versions')
            ->with(['articleTopos.article' => function($query) {
                $query->where('publish','1');
            }])
            ->first();

        // Si le label à changé alors on redirige
        if(Topo::webUrl($topo_id, $topo_title) != $topo->url()) {
            return $this->topoRedirectionPage($topo_id);
        }

        // Compte le nombre d'article on vide
        $nbArticle = 0;
        foreach ($topo->articleTopos as $articleTopo) {
            if ($articleTopo->article != null) {
                $nbArticle++;
            }
        }

        //on va chercher si l'utilisateur follow ce topo
        $follow = Follow::class;
        $userFollow = $follow::where(
            [
                ['user_id', '=', Auth::id()],
                ['followed_type', '=', 'App\Topo'],
                ['followed_id', '=', $topo->id]
            ]
        )->first();
        $userFollow = (isset($userFollow)) ? 'true' : 'false';

        $topo->views++;
        $topo->save();

        // Récupération des infos du vieux campeur
        $data_vc = $topo->getVieuxCampeurInformation();

        // Photo
        $photoCount = 0;
        foreach ($topo->crags as $crag) {
            $photoCount += count($crag->crag->AllPhoto());
        }
        $data = [
            'topo' => $topo,
            'meta_title' => $topo['label'],
            'meta_description' => 'description de ' . $topo['label'],
            'user_follow' => $userFollow,
            'nbArticle' => $nbArticle,
            'data_vc' => $data_vc,
            'photos_count' => $photoCount
        ];

        return view('pages.topo.topo', $data);
    }

    //RETOURNE LES TOPOS DANS UN RAYON AUTOUR D'UN POINT DONNÉE
    public function getToposArroundPoint($lat, $lng, $rayon, $crag_id){

        //on liste les topos du site pour les exclures de la recherche par la suite
        $crag = Crag::class;
        $cragTopos = $crag::where('id',$crag_id)->with('topos')->first();
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

        $Topo = Topo::class;
        $topos = [];
        foreach ($toposInRayon as $topo) $topos[] = $topo->id;
        $data = ['topos' => $Topo::whereIn('id',$topos)->get(), 'rayon' => $rayon];

        return view('pages.crag.partials.liste-topos', $data);
    }

    public function getToposByName($crag_id, $name){

        $Crag = Crag::class;
        $topo_ids = $Crag::where('crags.id',$crag_id)
            ->with('topos')
            ->get()
            ->pluck('topos')
            ->collapse()
            ->pluck('topo_id');

        $topos = Searchy::search('topos')->fields('label')->query($name)->getQuery()->whereNotIn('id', $topo_ids)->limit(20)->get();

        $data = ['topos' => $topos];

        return view('pages.crag.partials.liste-topos-search', $data);
    }

    public function topoRedirectionPage($topo_id) {
        $Topo = Topo::class;
        $topo = $Topo::find($topo_id);
        return redirect($topo->url(),301);
    }
}
