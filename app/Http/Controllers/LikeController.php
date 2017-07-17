<?php

namespace App\Http\Controllers;

use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    //RETOURNE LA VUE D'UN FLUX EN PARTICULIER (USER, CRAG, MASSIVE, TOPO ...ETC)
    function addLike(Request $request){

        $user = User::where('id',Auth::id())->first();

        //par s'écurité on supprime les éventuels like sur le même élement par le même user (même si on ajoute un like)
        $likes = Like::where([
            ['likable_id',$request->input('likable_id')],
            ['likable_type', 'App\\' . $request->input('likable_type')],
            ['user_id',$user->id]
        ])->get();
        foreach ($likes as $like){
            $like->delete();
        }

        //si on ajoute alors on ajoute
        if($request->input('likable') == true) {
            $like = new Like();
            $like->likable_id = $request->input('likable_id');
            $like->likable_type = 'App\\' . $request->input('likable_type');
            $like->user_id = $user->id;
            $like->save();
        }
        $data = [];

        return response()->json($data);
    }
}
