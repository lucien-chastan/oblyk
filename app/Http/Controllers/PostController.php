<?php

namespace App\Http\Controllers;

use App\Description;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    //Retourne la vue de plusieurs post
    function postsVue(Request $request){

        $posts = Post::where([
            ['postable_type','App\\' . $request->input('postable_type')],
            ['postable_id',$request->input('postable_id')]
        ])
            ->with('user')
            ->with('postable')
            ->with('descriptions.user')
            ->orderBy('created_at','desc')
            ->get();

        $data = [
            'posts' => $posts,
            'postable_type' => $request->input('postable_type'),
            'postable_id' => $request->input('postable_id')
        ];

        return view('pages.posts.posts', $data);
    }

    function userActuality(Request $request){

        $user = User::where('id', Auth::id())->with('follows')->first();

        $crags = $users = $topos = $massives = $comments = [];

        //Liste des id dans les éléments que l'utilisateur suit
        foreach ($user->follows as $follow){
            if($follow->followed_type == 'App\\Crag') $crags[] = $follow->followed_id;
            if($follow->followed_type == 'App\\Topo') $topos[] = $follow->followed_id;
            if($follow->followed_type == 'App\\User') $users[] = $follow->followed_id;
            if($follow->followed_type == 'App\\Massive') $massives[] = $follow->followed_id;
        }

        //liste des id que l'utilisateur à commenté
        $findComments = Description::where([['descriptive_type', 'App\\Post'],['user_id',$user->id]])->get();
        foreach ($findComments as $comment){
            $comments[] = $comment->descriptive_id;
        }

        $posts = Post::where(function ($query) use ( $crags ) {$query->where('postable_type', '=', 'App\\Crag')->whereIn('postable_id', $crags);})
            ->orWhere(function ($query) use ( $topos ) {$query->where('postable_type', '=', 'App\\Topo')->whereIn('postable_id', $topos);})
            ->orWhere(function ($query) use ( $users ) {$query->where('postable_type', '=', 'App\\User')->whereIn('postable_id', $users);})
            ->orWhere(function ($query) use ( $massives ) {$query->where('postable_type', '=', 'App\\Massive')->whereIn('postable_id', $massives);})
            ->orWhere(function ($query) use ( $comments ) {$query->whereIn('id', $comments);})
            ->orWhere('user_id',$user->id)
            ->with('user')
            ->with('postable')
            ->with('descriptions.user')
            ->orderBy('created_at','desc')
            ->get();

        $data = [
            'posts' => $posts,
            'postable_type' => 'App\User',
            'postable_id' => $user->id
        ];

        return view('pages.posts.posts', $data);
    }


    //Retourne la vue d'un post
    function getOnePost(Request $request){
        $post = Post::where('id', $request->input('id'))->with('descriptions.user')->first();
        $data = [
            'post' => $post
        ];

        return view('pages.posts.onePost', $data);
    }

}
