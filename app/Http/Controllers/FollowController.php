<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{

    //retourne les tous les éléments suivi par l'utilsateur cible
    function getUserFollows(Request $request){

        $follows = [];
        $findFollows = Follow::where('user_id', $request->input('user_id'))
            ->with('followed')
            ->get();

        foreach ($findFollows as $follow){

            //FALAISE
            if($follow->followed_type == 'App\Crag'){
                $follow->followUrl = route('cragPage', ['crag_id'=>$follow->followed_id, 'crag_label'=>str_slug($follow->followed->label)]);
                $follow->followName = $follow->followed->label;
                $follow->followIcon = ($follow->followed->bandeau == "/img/default-crag-bandeau.jpg") ? "/img/icon-search-crag.svg" : str_replace("1300", "50", $follow->followed->bandeau);
                $follow->followInformation = $follow->followed->region . ', ' . ($follow->followed->code_country);
            }

            //TOPO
            if($follow->followed_type == 'App\Topo'){
                $follow->followUrl = route('topoPage', ['topo_id'=>$follow->followed_id, 'topo_label'=>str_slug($follow->followed->label)]);
                $follow->followName = $follow->followed->label;
                $follow->followIcon = (file_exists(storage_path('app/public/topos/50/topo-' . $follow->followed->id . '.jpg'))) ? '/storage/topos/50/topo-' . $follow->followed->id . '.jpg' : '/img/default-topo-couverture.svg';
                $follow->followInformation = $follow->followed->editor . ', ' . $follow->followed->editionYear;
            }

            $follows[] = $follow;
        }

        return response()->json(['follows' => $follows]);
    }

}
