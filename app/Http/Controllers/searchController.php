<?php

namespace App\Http\Controllers;

use App\ForumTopic;
use App\Route;
use TomLingham\Searchy\Facades\Searchy;

class searchController extends Controller
{

    public function search($limit, $offset, $type, $search){

        $finds = [];
        $relevance_min = 20;

        // WORDS
        if($type == 'words' || $type == 'all') {
            foreach (Searchy::search('words')->fields('label')->query($search)->getQuery()->having('relevance', '>', $relevance_min)->get() as $find) {
                $find->searchable_type = 'App\Word';
                $finds[] = ['relevance' => $find->relevance, 'data' => $find];
            }
        }

        // CRAGS
        if($type == 'crags' || $type == 'all') {
            foreach (Searchy::search('crags')->fields('label', 'city')->query($search)->getQuery()->having('relevance', '>', $relevance_min)->limit(10)->get() as $find) {
                $find->searchable_type = 'App\Crag';
                $finds[] = ['relevance' => $find->relevance, 'data' => $find];
            }
        }

        // USERS
        if($type == 'users' || $type == 'all') {
            foreach (Searchy::search('users')->fields('name')->query($search)->getQuery()->having('relevance', '>', $relevance_min)->limit(10)->get() as $find) {
                $find->searchable_type = 'App\User';
                $finds[] = ['relevance' => $find->relevance, 'data' => $find];
            }
        }

        // CLIMBING GYM
        if($type == 'gyms' || $type == 'all') {
            foreach (Searchy::search('gyms')->fields('label', 'city', 'big_city')->query($search)->getQuery()->having('relevance', '>', $relevance_min)->limit(10)->get() as $find) {
                $find->searchable_type = 'App\Gym';
                $finds[] = ['relevance' => $find->relevance, 'data' => $find];
            }
        }

        // ROUTE
        if($type == 'routes' || $type == 'all') {
            foreach (Searchy::search('routes')->fields('label')->query($search)->select('id')->getQuery()->having('relevance', '>', $relevance_min)->limit(20)->get() as $find) {
                $route = Route::where('id', $find->id)->with('crag')->with('routeSections')->first();
                $route->searchable_type = 'App\Route';
                $finds[] = ['relevance' => $find->relevance, 'data' => $route];
            }
        }

        // HELPS
        if($type == 'helps' || $type == 'all') {
            foreach (Searchy::search('helps')->fields('label', 'category')->query($search)->getQuery()->having('relevance', '>', $relevance_min)->limit(10)->get() as $find) {
                $find->searchable_type = 'App\Help';
                $finds[] = ['relevance' => $find->relevance, 'data' => $find];
            }
        }

        // FORUM
        if($type == 'topics' || $type == 'all') {
            foreach (Searchy::search('forum_topics')->fields('label')->query($search)->select('id')->getQuery()->having('relevance', '>', $relevance_min)->limit(10)->get() as $find) {
                $topic = ForumTopic::where('id', $find->id)->with('user')->first();
                $topic->searchable_type = 'App\Topic';
                $finds[] = ['relevance' => $find->relevance, 'data' => $topic];
            }
        }

        // TOPOS
        if($type == 'topos' || $type == 'all') {
            foreach (Searchy::search('topos')->fields('label')->query($search)->getQuery()->having('relevance', '>', $relevance_min)->limit(10)->get() as $find) {
                $find->searchable_type = 'App\Topo';
                $finds[] = ['relevance' => $find->relevance, 'data' => $find];
            }
        }

        // SORT ARRAY BY RELEVANCE
        array_multisort (array_column($finds, 'relevance'), SORT_DESC, $finds);

        // RE CREATE ARRAY WITH ONE LEVEL
        $sort_finds = [];
        foreach ($finds as $find) {
            $sort_finds[] = $find['data'];
        }

        $data = [
            'search' => $search,
            'type' => $type,
            'finds' => $sort_finds,
        ];

        return view('pages.global-search.elasticVue', $data);
    }
}
