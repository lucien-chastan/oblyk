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

            if( $follow->followed_type != 'App\ForumTopic') {

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

                //MASSIF
                if($follow->followed_type == 'App\Massive'){
                    $follow->followUrl = route('massivePage', ['massive_id'=>$follow->followed_id, 'massive_label'=>str_slug($follow->followed->label)]);
                    $follow->followName = $follow->followed->label;
                    $follow->followIcon = '/img/icon-search-massive.svg';
                    $follow->followInformation = 'regroupement de site';
                }

                //USER
                if($follow->followed_type == 'App\User'){
                    $follow->followUrl = route('userPage', ['user_id'=>$follow->followed_id, 'user_name'=>str_slug($follow->followed->name)]);
                    $follow->followName = $follow->followed->name;
                    $follow->followIcon = file_exists(storage_path('app/public/users/50/user-' . $follow->followed_id . '.jpg')) ? '/storage/users/50/user-' . $follow->followed_id . '.jpg' : '/img/icon-search-user.svg';

                    $genre = '';
                    if($follow->followed->sex == 0) $genre = "Indéfini";
                    if($follow->followed->sex == 1) $genre = "Femme";
                    if($follow->followed->sex == 2) $genre = "Homme";
                    $age = $follow->followed->birth != 0 ? date('Y') - $follow->followed->birth : '?';

                    $follow->followInformation = $genre . ', ' . $age . ' ans';
                }

                //SALLE
                if($follow->followed_type == 'App\Gym'){
                    $follow->followUrl = route('gymPage', ['gym_id'=>$follow->followed_id, 'gym_name'=>str_slug($follow->followed->label)]);
                    $follow->followName = $follow->followed->label;
                    $follow->followIcon = file_exists(storage_path('app/public/gyms/100/logo-' . $follow->followed_id . '.png')) ? '/storage/gyms/100/logo-' . $follow->followed_id . '.png' : '/img/icon-search-gym.svg';
                    $follow->followInformation = $follow->followed->big_city . ' (' . $follow->followed->code_country . ')';
                }

                $follows[] = $follow;

            }
        }

        return response()->json(['follows' => $follows]);
    }

}
