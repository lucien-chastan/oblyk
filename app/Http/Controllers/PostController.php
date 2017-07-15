<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    //Retourne la vue de plusieurs post
    function postsVue(Request $request){

        $posts = Post::where([
            ['postable_type','App\\' . $request->input('postable_type')],
            ['postable_id',$request->input('postable_id')]
        ])->with('user')->with('descriptions.user')->orderBy('created_at','desc')->get();

        $data = [
            'posts' => $posts,
            'postable_type' => $request->input('postable_type'),
            'postable_id' => $request->input('postable_id')
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
