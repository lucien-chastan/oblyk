<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    //RETOURNE LA VUE D'UN FLUX EN PARTICULIER (USER, CRAG, MASSIVE, TOPO ...ETC)
    function postsVue(Request $request){

        $skip = $request->input('skip');
        $take = $request->input('take');

        $posts = Post::where([
            ['postable_type','App\\' . $request->input('postable_type')],
            ['postable_id',$request->input('postable_id')]
        ])
            ->with('user')
            ->with('postable')
            ->with('likes')
            ->with('comments.user')
            ->with('comments.likes')
            ->with('comments.comments.user')
            ->with('comments.comments.likes')
            ->orderBy('created_at','desc')
            ->skip($skip)
            ->take($take)
            ->get();

        $data = [
            'posts' => $posts,
            'postable_type' => $request->input('postable_type'),
            'postable_id' => $request->input('postable_id'),
            'skip' => $skip,
            'take' => $take,
            'last_read' => Carbon::now()
        ];

        return view('pages.posts.posts', $data);
    }


    //RETOURNE LA VUE DE TOUS LES POSTS QUI CONCERNE L'UTILISATEUR CONNECTÉ
    function userActuality(Request $request){

        if($request->input('postable_id') == Auth::id()){


            // SI NOUS SOMME SUR LE FLUX DE LA PERSONNE CONNECTÉ

            $user = User::where('id', Auth::id())->with('follows')->first();

            $crags = $users = $topos = $massives = $comments = $topics = $gyms = [];

            $skip = $request->input('skip');
            $take = $request->input('take');

            //on sauvegarde la valeur de l'ancienne lecture
            $old_last_fil_read = $user->last_fil_read;

            //si notre skip est à zero alors on va enregistrer dans le profil la dernière date de lecture
            if($skip == 0){
                $user->last_fil_read = Carbon::now();
                $user->save();
            }

            //Liste des id dans les éléments que l'utilisateur suit
            foreach ($user->follows as $follow){
                if($follow->followed_type == 'App\\Crag') $crags[] = $follow->followed_id;
                if($follow->followed_type == 'App\\Topo') $topos[] = $follow->followed_id;
                if($follow->followed_type == 'App\\User') $users[] = $follow->followed_id;
                if($follow->followed_type == 'App\\Massive') $massives[] = $follow->followed_id;
                if($follow->followed_type == 'App\\ForumTopic') $topics[] = $follow->followed_id;
                if($follow->followed_type == 'App\\Gym') $gyms[] = $follow->followed_id;
            }

            //liste des id que l'utilisateur à commenté
            $findComments = Comment::where([['commentable_type', 'App\\Post'],['user_id',$user->id]])->get();
            foreach ($findComments as $comment){
                $comments[] = $comment->commentable_id;
            }


            $posts = Post::where(function ($query) use ( $crags ) {$query->where('postable_type', '=', 'App\\Crag')->whereIn('postable_id', $crags);})
                ->orWhere(function ($query) use ( $topos ) {$query->where('postable_type', '=', 'App\\Topo')->whereIn('postable_id', $topos);})
                ->orWhere(function ($query) use ( $users ) {$query->where('postable_type', '=', 'App\\User')->whereIn('postable_id', $users);})
                ->orWhere(function ($query) use ( $massives ) {$query->where('postable_type', '=', 'App\\Massive')->whereIn('postable_id', $massives);})
                ->orWhere(function ($query) use ( $topics ) {$query->where('postable_type', '=', 'App\\ForumTopic')->whereIn('postable_id', $topics);})
                ->orWhere(function ($query) use ( $gyms ) {$query->where('postable_type', '=', 'App\\Gym')->whereIn('postable_id', $gyms);})
                ->orWhere(function ($query) use ( $comments ) {$query->whereIn('id', $comments);})
                ->orWhere([['postable_type','App\\User'],['postable_id',$user->id]])
                ->orWhere('user_id',$user->id)
                ->with('user')
                ->with('postable')
                ->with('likes')
                ->with('comments.user')
                ->with('comments.likes')
                ->with('comments.comments.user')
                ->with('comments.comments.likes')
                ->orderBy('created_at','desc')
                ->skip($skip)
                ->take($take)
                ->get();

            $data = [
                'posts' => $posts,
                'postable_type' => 'App\User',
                'postable_id' => $user->id,
                'skip' => $skip,
                'take' => $take,
                'last_read' => $old_last_fil_read
            ];

        }else{


            //SI NOUS SOMME SUR LE FIL D'UN AUTRE PROFIL

            $user = User::where('id', $request->input('postable_id'))->first();

            $skip = $request->input('skip');
            $take = $request->input('take');

            $posts = Post::where([
                ['postable_type','App\\User'],
                ['postable_id',$user->id]
            ])
                ->with('user')
                ->with('postable')
                ->with('likes')
                ->with('comments.user')
                ->with('comments.likes')
                ->with('comments.comments.user')
                ->with('comments.comments.likes')
                ->orderBy('created_at','desc')
                ->skip($skip)
                ->take($take)
                ->get();

            $data = [
                'posts' => $posts,
                'postable_type' => $request->input('postable_type'),
                'postable_id' => $request->input('postable_id'),
                'skip' => $skip,
                'take' => $take,
                'last_read' => Carbon::now()
            ];

        }


        return view('pages.posts.posts', $data);
    }


    //RETOURNE LA VUE D'UN POST APRÈS UN RELOAD
    function getOnePost(Request $request){

        $user = User::where('id',Auth::id())->first();

        $post = Post::where('id', $request->input('id'))
            ->with('likes')
            ->with('comments.user')
            ->with('comments.likes')
            ->with('comments.comments.user')
            ->with('comments.comments.likes')
            ->first();
        $data = [
            'post' => $post,
            'postable_type' => $post->postable_type,
            'postable_id' => $post->postable_id,
            'last_read' => $user->last_fil_read
        ];

        return view('pages.posts.onePost', $data);
    }


    //RETOURNE LA VUE D'UN POST (APRÈS LE CLIC SUR UNE NOTIFICATION PAR EXEMPLE)
    function vueOnePost(Request $request){
        $user = User::where('id',Auth::id())->first();

        $post = Post::where('id', $request->input('id'))
            ->with('likes')
            ->with('comments.user')
            ->with('comments.likes')
            ->with('comments.comments.user')
            ->with('comments.comments.likes')
            ->first();
        $data = [
            'post' => $post,
            'postable_type' => $post->postable_type,
            'postable_id' => $post->postable_id,
            'last_read' => $user->last_fil_read
        ];

        return view('pages.posts.vueOnePost', $data);
    }
}
