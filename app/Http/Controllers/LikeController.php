<?php

namespace App\Http\Controllers;

use App\Like;
use App\Notification;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    //AFFICHE LA MODAL DES UTILISATEURS QUI ONT LIKÉ
    function likeModal(Request $request){

        $likes = Like::where([
            ['likable_id',$request->input('likable_id')],
            ['likable_type','App\\' . $request->input('likable_type')]
        ])->with('user')->get();

        $data = [
            'title' => $request->input('title'),
            'likes' => $likes
        ];

        return view('modal.like', $data);

    }

    //AJOUTE UN LIKE SUR L'ÉLÉMENT CIBLE
    function addLike(Request $request){

        $userAuth = User::where('id',Auth::id())->first();

        //par s'écurité on supprime les éventuels like sur le même élement par le même user (même si on ajoute un like)
        $likes = Like::where([
            ['likable_id',$request->input('likable_id')],
            ['likable_type', 'App\\' . $request->input('likable_type')],
            ['user_id',$userAuth->id]
        ])->get();
        foreach ($likes as $like){
            $like->delete();
        }

        //si on ajoute alors on ajoute
        if($request->input('likable') == true) {
            $like = new Like();
            $like->likable_id = $request->input('likable_id');
            $like->likable_type = 'App\\' . $request->input('likable_type');
            $like->user_id = $userAuth->id;
            $like->save();


            //LES NOTIFICATIONS
            $post = Post::where('id', $request->input('post_id'))->with('postable')->first();
            $like = Like::where('id', $like->id)->with('likable.user')->first();

            //si l'utilisateur s'auto like on ne le notifi pas
            if($like->user_id != $like->likable->user->id){

                //SUIVANT LES DIFFÉRENTS TYPE DE LIKE
                $type = '';
                if($request->input('type') == 'Post') $type = 'post_like';
                if($request->input('type') == 'Comment') $type = 'comment_like';
                if($request->input('type') == 'SubComment') $type = 'sub_comment_like';

                $notification = new Notification();
                $notification->user_id = $like->likable->user->id;
                $notification->type = $type;
                $notification->data = Notification::jsonData(
                    $type,
                    [$userAuth->name, $post->postable->label],
                    '/img/icon-fil-actu.svg',
                    [route('userPage',['user_id'=>$userAuth->id,'user_label'=>str_slug($userAuth->name)]), $userAuth->name],
                    [$post->id]
                );
                $notification->save();
            }
        }

        $data = [];

        return response()->json($data);
    }
}
