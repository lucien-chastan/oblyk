<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Massive;
use App\Route;
use App\Topo;
use App\TopoPdf;
use App\TopoWeb;
use App\User;
use App\Word;
use Illuminate\Http\Request;

class searchController extends Controller
{
    //CONTROLLER DES PETITES PAGES LIÉES AU PROJET, TELLE QUE "QUI SOMME NOUS", "LE PORJET", "MENTIONS LÉGALE", ETC.
    public function search($search){


        //RECHERCHE SUR LES MASSIFS
        $massives = [];
        $findMassives = Massive::where('label', 'like', '%' . $search . '%')->withCount('crags')->orderBy('views', 'desc')->get();
        foreach ($findMassives as $massive){
            $massive->url = route('massivePage', ['massive_id'=>$massive->id, 'massive_label'=>str_slug($massive->label)]);
            $massives[] = $massive;
        }

        //RECHERCHE SUR LES FALAISES
        $crags = [];
        $findCrags = Crag::where('label', 'like', '%' . $search . '%')->orderBy('views', 'desc')->get();
        foreach ($findCrags as $crag){
            $crag->url = route('cragPage', ['crag_id'=>$crag->id, 'crag_label'=>str_slug($crag->label)]);
            $crag->bandeau = ($crag->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $crag->bandeau);
            $crag->climbType = $crag->type_voie . $crag->type_grande_voie . $crag->type_bloc . $crag->type_deep_water . $crag->type_via_ferrata;
            $crags[] = $crag;
        }


        //RECHERCHE SUR LES MOTS DU LEXIQUE
        $words = Word::where('label', 'like', '%' . $search . '%')->orderBy('label')->get();


        //RECHERCHE SUR LES TOPOS
        $topos = [];
        $findTopos = Topo::where('label','like','%' . $search . '%')->orderBy('views', 'desc')->get();
        foreach ($findTopos as $topo){
            $topo->url = route('topoPage', ['topo_id'=>$topo->id, 'crag_label'=>str_slug($topo->label)]);
            $topo->couverture = (file_exists(storage_path('app/public/topos/50/topo-' . $topo->id . '.jpg'))) ? '/storage/topos/50/topo-' . $topo->id . '.jpg' : '/img/default-topo-couverture.svg';
            $topos[] = $topo;
        }


        //RECHERCHE SUR LES TOPOS PDF
        $topoPdfs = [];
        $findTopoPdfs = TopoPdf::where('label','like','%' . $search . '%')->with('crag')->orderBy('label', 'asc')->get();
        foreach ($findTopoPdfs as $pdf){
            $pdf->url = '/storage/topos/PDF/' . $pdf->slug_label;
            $pdf->CragUrl = route('cragPage', ['crag_id'=>$pdf->crag->id, 'crag_label'=>str_slug($pdf->crag->label)]);
            $pdf->couverture = '/img/default-topo-pdf-couverture.svg';
            $topoPdfs[] = $pdf;
        }

        //RECHERCHE SUR LES TOPOS WEB
        $topoWebs = [];
        $findTopoWebs = TopoWeb::where('label','like','%' . $search . '%')->with('crag')->orderBy('label', 'asc')->get();
        foreach ($findTopoWebs as $web){
            $web->CragUrl = route('cragPage', ['crag_id'=>$web->crag->id, 'crag_label'=>str_slug($web->crag->label)]);
            $web->couverture = '/img/default-topo-web-couverture.svg';
            $topoWebs[] = $web;
        }

        //RECHERCHE SUR LES ROUTES
        $routes = [];
        $findRoutes = Route::where('label','like','%' . $search . '%')->with('routeSections')->with('crag')->orderBy('views', 'desc')->get();
        foreach ($findRoutes as $route){
            $route->cragUrl = route('cragPage', ['crag_id'=>$route->crag->id, 'crag_label'=>str_slug($route->crag->label)]);
            $route->url = route('vueRouteRoute', ['route_id'=>$route->id]);
            $route->bandeau = ($route->crag->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $route->crag->bandeau);
            if(count($route->routeSections) == 1){
                $route->cotation = $route->routeSections[0]->grade . $route->routeSections[0]->sub_grade;
                $route->color = $route->routeSections[0]->grade_val;
            }else {
                $route->cotation = count($route->routeSections) . ' L.';
                $route->color = 54;
            }
            $routes[] = $route;
        }

        //RECHERCHE SUR LES UTILISATEURS
        $users = [];
        $findUsers = User::where('name','like','%' . $search . '%')->orderBy('name', 'asc')->get();
        foreach ($findUsers as $user){
            $user->url = '/';
            $user->photo = '/img/icon-search-user.svg';
            $users[] = $user;
        }

        $data = [
            'search' => $search,
            'nombre' => [
                'crags' => count($crags),
                'massives' => count($massives),
                'routes' => count($routes),
                'topos' => count($topos),
                'topoPdfs' => count($topoPdfs),
                'topoWebs' => count($topoWebs),
                'users' => count($users),
                'words' => count($words),
                'aides' => 0,
            ],
            'crags' => $crags,
            'massives' => $massives,
            'topos' => $topos,
            'topoPdfs' => $topoPdfs,
            'topoWebs' => $topoWebs,
            'words' => $words,
            'routes' => $routes,
            'users' => $users,
        ];

        return response()->json($data);
    }

}
