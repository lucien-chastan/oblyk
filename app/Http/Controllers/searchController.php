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
use TomLingham\Searchy\Facades\Searchy;

class searchController extends Controller
{

    public function search($limit, $offset, $type, $search){

        $finds = [];

        if($type == 'words') $finds = Searchy::search('words')->fields('label', 'definition')->query($search)->getQuery()->limit(20)->get();
        if($type == 'crags') $finds = Searchy::search('crags')->fields('label', 'city', 'region')->query($search)->getQuery()->limit(20)->get();
        if($type == 'users') $finds = Searchy::search('users')->fields('name', 'localisation')->query($search)->getQuery()->limit(20)->get();
        if($type == 'gyms') $finds = Searchy::search('gyms')->fields('label', 'description', 'city', 'big_city')->query($search)->getQuery()->limit(20)->get();
        if($type == 'routes') {
            $finds = Searchy::search('routes')->fields('label')->query($search)->getQuery()->limit(20)->get();
            $loadsElements = [];
            foreach ($finds as $find) $loadsElements[] = Route::where('id', $find->id)->with('crag')->with('routeSections')->first();
            $finds = $loadsElements;
        }
        if($type == 'helps') $finds = Searchy::search('helps')->fields('label', 'category', 'contents')->query($search)->getQuery()->limit(20)->get();
        if($type == 'topics') {
            $finds = Searchy::search('forum_topics')->fields('label')->query($search)->getQuery()->limit(20)->get();
            $loadsElements = [];
            foreach ($finds as $find) $loadsElements[] = ForumTopic::where('id', $find->id)->with('user')->first();
            $finds = $loadsElements;
        }
        if($type == 'topos') $finds = Searchy::search('topos')->fields('label', 'author', 'editor')->query($search)->getQuery()->limit(20)->get();

        $data = [
            'search' => $search,
            'type' => $type,
            'finds' => $finds,
        ];

        return view('pages.global-search.elasticVue', $data);
    }

}
