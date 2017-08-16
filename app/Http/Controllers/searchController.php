<?php

namespace App\Http\Controllers;

use App\Crag;
use App\ForumTopic;
use App\Gym;
use App\Help;
use App\Massive;
use App\Route;
use App\Search;
use App\Topo;
use App\TopoPdf;
use App\TopoWeb;
use App\User;
use App\Word;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;

class searchController extends Controller
{

    public function search($limit, $offset, $search){

        //RECHERCHE SUR LA TABLES INDEXÉE SEARCHES
        $finds = Search::find($search, $limit, $offset);
        $searches = [];
        if(count($finds) > 0){
            $searches = Search::whereIn('id', $finds)->with('searchable')->get();
        }

//
//        //RECHERCHE SUR LES MASSIFS
//        $massives = [];
//        $findMassives = Massive::where('label', 'like', '%' . $search . '%')->withCount('crags')->orderBy('views', 'desc')->get();
//        foreach ($findMassives as $massive){
//            $massive->url = route('massivePage', ['massive_id'=>$massive->id, 'massive_label'=>str_slug($massive->label)]);
//            $massives[] = $massive;
//        }
//
//        //RECHERCHE SUR LES TOPOS
//        $topos = [];
//        $findTopos = Topo::where('label','like','%' . $search . '%')->orderBy('views', 'desc')->get();
//        foreach ($findTopos as $topo){
//            $topo->url = route('topoPage', ['topo_id'=>$topo->id, 'crag_label'=>str_slug($topo->label)]);
//            $topo->couverture = (file_exists(storage_path('app/public/topos/50/topo-' . $topo->id . '.jpg'))) ? '/storage/topos/50/topo-' . $topo->id . '.jpg' : '/img/default-topo-couverture.svg';
//            $topos[] = $topo;
//        }
//
//
//        //RECHERCHE SUR LES TOPOS PDF
//        $topoPdfs = [];
//        $findTopoPdfs = TopoPdf::where('label','like','%' . $search . '%')->with('crag')->orderBy('label', 'asc')->get();
//        foreach ($findTopoPdfs as $pdf){
//            $pdf->url = '/storage/topos/PDF/' . $pdf->slug_label;
//            $pdf->CragUrl = route('cragPage', ['crag_id'=>$pdf->crag->id, 'crag_label'=>str_slug($pdf->crag->label)]);
//            $pdf->couverture = '/img/default-topo-pdf-couverture.svg';
//            $topoPdfs[] = $pdf;
//        }
//
//        //RECHERCHE SUR LES TOPOS WEB
//        $topoWebs = [];
//        $findTopoWebs = TopoWeb::where('label','like','%' . $search . '%')->with('crag')->orderBy('label', 'asc')->get();
//        foreach ($findTopoWebs as $web){
//            $web->CragUrl = route('cragPage', ['crag_id'=>$web->crag->id, 'crag_label'=>str_slug($web->crag->label)]);
//            $web->couverture = '/img/default-topo-web-couverture.svg';
//            $topoWebs[] = $web;
//        }
//
//        //RECHERCHE SUR LES ROUTES
//        $routes = [];
//        $findRoutes = Route::where('label','like','%' . $search . '%')->with('routeSections')->with('crag')->orderBy('views', 'desc')->get();
//        foreach ($findRoutes as $route){
//            $route->cragUrl = route('cragPage', ['crag_id'=>$route->crag->id, 'crag_label'=>str_slug($route->crag->label)]);
//            $route->url = route('vueRouteRoute', ['route_id'=>$route->id]);
//            $route->bandeau = ($route->crag->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $route->crag->bandeau);
//            if(count($route->routeSections) == 1){
//                $route->cotation = $route->routeSections[0]->grade . $route->routeSections[0]->sub_grade;
//                $route->color = $route->routeSections[0]->grade_val;
//            }else {
//                $route->cotation = count($route->routeSections) . ' L.';
//                $route->color = 54;
//            }
//            $routes[] = $route;
//        }



//        //RECHERCHE SUR LE FORUM
//        $topics = [];
//        $findTopics = ForumTopic::where([['label','like','%' . $search . '%'],['nb_post','>',0]])->with('user')->orderBy('label', 'asc')->get();
//        foreach ($findTopics as $topic){
//            $topic->url = route('topicPage', ['topic_id'=>$topic->id,'topic_label'=>str_slug($topic->label)]);
//            $topic->user->url = route('userPage', ['user_id'=>$topic->user->id,'user_label'=>str_slug($topic->user->name)]);
//            $topic->icon = '/img/icon-search-user.svg';
//
//            $topics[] = $topic;
//        }
//
//        //RECHERCHE SUR LES SALLES D'ESCALADE
//        $gyms = [];
//        $findGyms = Gym::where('label','like','%' . $search . '%')
//            ->orWhere('city','like','%' . $search . '%')
//            ->orWhere('big_city','like','%' . $search . '%')
//            ->orderBy('views', 'desc')
//            ->get();
//        foreach ($findGyms as $gym){
//            $gym->url = route('gymPage', ['gym_id'=>$gym->id,'gym_label'=>str_slug($gym->label)]);
//            $gym->icon = file_exists(storage_path('app/public/gyms/50/logo-' . $gym->id . '.png')) ? '/storage/gyms/50/logo-' . $gym->id . '.png' : '/img/icon-search-gym.svg';
//
//            $gyms[] = $gym;
//        }
//
//
//        //RECHERCHE SUR LES AIDES
//        $helps = Help::where('label','like','%' . $search . '%')->orWhere('category','like','%' . $search . '%')->orderBy('label', 'asc')->get();
//
//
//
//        $data = [
//            'search' => $search,
//            'nombre' => [
//                'crags' => count($crags),
//                'massives' => count($massives),
//                'routes' => count($routes),
//                'topos' => count($topos),
//                'topoPdfs' => count($topoPdfs),
//                'topoWebs' => count($topoWebs),
//                'users' => count($users),
//                'words' => count($words),
//                'topics' => count($topics),
//                'aides' => count($helps),
//                'gyms' => count($gyms),
//            ],
//            'crags' => $crags,
//            'massives' => $massives,
//            'topos' => $topos,
//            'topoPdfs' => $topoPdfs,
//            'topoWebs' => $topoWebs,
//            'words' => $words,
//            'routes' => $routes,
//            'topics' => $topics,
//            'users' => $users,
//            'aides' => $helps,
//            'gyms' => $gyms,
//        ];

//        return response()->json($data);


        $data = [
            'search' => $search,
            'limit' => $limit,
            'offset' => $offset,
            'finds' => $searches
        ];

        //view
        return view('pages.global-search.searchesVue', $data);
    }

}
