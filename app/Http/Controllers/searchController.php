<?php

namespace App\Http\Controllers;

use App\Crag;
use App\ForumTopic;
use App\Gym;
use App\Help;
use App\Massive;
use App\MassiveCrag;
use App\Route;
use App\RouteSection;
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
            $findSearches = Search::whereIn('id', $finds)
                ->with('searchable')
                ->get();

            foreach ($findSearches as $findSearch){

                //Infos supplémentaires sur les routes
                if($findSearch->searchable_type == 'App\Route') {
                    $findSearch->searchable->crag = Crag::where('id', $findSearch->searchable->crag_id)->first();
                    $findSearch->searchable->routeSections = RouteSection::where('route_id', $findSearch->searchable->id)->get();
                }

                //Infos supplémentaires sur les topos PDF ou Web
                if($findSearch->searchable_type == 'App\TopoPdf' || $findSearch->searchable_type == 'App\TopoWeb') {
                    $findSearch->searchable->crag = Crag::where('id', $findSearch->searchable->crag_id)->first();
                }

                //Infos supplémentaires sur les massif
                if($findSearch->searchable_type == 'App\Massive') {
                    $findSearch->searchable->crags = MassiveCrag::where('massive_id', $findSearch->searchable->id)->get();
                }

                //Infos supplémentaires sur les topics
                if($findSearch->searchable_type == 'App\ForumTopic') {
                    $findSearch->searchable->user = User::where('id', $findSearch->searchable->user_id)->first();
                }

                $searches[] = $findSearch;
            }
        }

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
