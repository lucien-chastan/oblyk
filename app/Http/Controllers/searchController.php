<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Massive;
use App\Route;
use App\User;
use App\Word;
use Illuminate\Http\Request;

class searchController extends Controller
{
    //CONTROLLER DES PETITES PAGES LIÉES AU PROJET, TELLE QUE "QUI SOMME NOUS", "LE PORJET", "MENTIONS LÉGALE", ETC.
    public function search($search){


        //RECHERCHE SUR LES MASSIFS
        $massives = [];
        $findMassives = Massive::where('label', 'like', '%' . $search . '%')->withCount('crags')->get();
        foreach ($findMassives as $massive){
            $massive->url = route('massivePage', ['massive_id'=>$massive->id, 'massive_label'=>str_slug($massive->label)]);
            $massives[] = $massive;
        }

        //RECHERCHE SUR LES FALAISES
        $crags = [];
        $findCrags = Crag::where('label', 'like', '%' . $search . '%')->get();
        foreach ($findCrags as $crag){
            $crag->url = route('cragPage', ['crag_id'=>$crag->id, 'crag_label'=>str_slug($crag->label)]);
            $crag->bandeau = ($crag->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $crag->bandeau);
            $crag->climbType = $crag->type_voie . $crag->type_grande_voie . $crag->type_bloc . $crag->type_deep_water . $crag->type_via_ferrata;
            $crags[] = $crag;
        }


        //RECHERCHE SUR LES MOTS DU LEXIQUE
        $words = Word::where('label', 'like', '%' . $search . '%')->get();


        //RECHERCHE SUR LES TOPOS

        //RECHERCHE SUR LES ROUTES
        $routes = [];
        $findRoutes = Route::where('label','like','%' . $search . '%')->with('routeSections')->with('crag')->get();
        foreach ($findRoutes as $route){
            $route->url = route('cragPage', ['crag_id'=>$route->crag->id, 'crag_label'=>str_slug($route->crag->label)]);
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
        $findUsers = User::where('name','like','%' . $search . '%')->get();
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
                'users' => count($users),
                'words' => count($words),
                'aides' => 0,
            ],
            'crags' => $crags,
            'massives' => $massives,
            'words' => $words,
            'routes' => $routes,
            'users' => $users,
        ];

        return response()->json($data);
    }

}
