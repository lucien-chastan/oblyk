<?php

namespace App\Http\Controllers;

use App\Crag;
use App\ForumTopic;
use App\Gym;
use App\Help;
use App\Route;
use App\Topo;
use App\User;
use App\Word;

class searchController extends Controller
{

    public function search($limit, $offset, $type, $search){


//        //RECHERCHE SUR LA TABLES INDEXÉE SEARCHES
//        $finds = Search::find($search, $limit, $offset);
//        $searches = [];
//        if(count($finds) > 0){
//            $findSearches = Search::whereIn('id', $finds)
//                ->with('searchable')
//                ->get();
//
//            foreach ($findSearches as $findSearch){
//
//                //Infos supplémentaires sur les routes
//                if($findSearch->searchable_type == 'App\Route') {
//                    $findSearch->searchable->crag = Crag::where('id', $findSearch->searchable->crag_id)->first();
//                    $findSearch->searchable->routeSections = RouteSection::where('route_id', $findSearch->searchable->id)->get();
//                }
//
//                //Infos supplémentaires sur les topos PDF ou Web
//                if($findSearch->searchable_type == 'App\TopoPdf' || $findSearch->searchable_type == 'App\TopoWeb') {
//                    $findSearch->searchable->crag = Crag::where('id', $findSearch->searchable->crag_id)->first();
//                }
//
//                //Infos supplémentaires sur les massif
//                if($findSearch->searchable_type == 'App\Massive') {
//                    $findSearch->searchable->crags = MassiveCrag::where('massive_id', $findSearch->searchable->id)->get();
//                }
//
//                //Infos supplémentaires sur les topics
//                if($findSearch->searchable_type == 'App\ForumTopic') {
//                    $findSearch->searchable->user = User::where('id', $findSearch->searchable->user_id)->first();
//                }
//
//                $searches[] = $findSearch;
//            }
//        }
//
//        $data = [
//            'search' => $search,
//            'limit' => $limit,
//            'offset' => $offset,
//            'finds' => $searches
//        ];

        $finds = [];

        if($type == 'words') $finds = Word::search($search);
        if($type == 'crags') $finds = Crag::search($search);
        if($type == 'users') $finds = User::search($search);
        if($type == 'gyms') $finds = Gym::search($search);
        if($type == 'routes'){ $finds = Route::search($search);}
        if($type == 'helps'){ $finds = Help::search($search);}
        if($type == 'topics'){ $finds = ForumTopic::search($search);}
        if($type == 'topos'){ $finds = Topo::search($search);}


        $data = [
            'search' => $search,
            'type' => $type,
            'finds' => $finds,
        ];

//
//        //view
//        return view('pages.global-search.searchesVue', $data);
        return view('pages.global-search.elasticVue', $data);
    }

}
