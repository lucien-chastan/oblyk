<?php

namespace App\Http\Controllers\CRUD;

use App\Notification;
use App\Post;
use Validator;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN ÉLEMENT
    function commentModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_comment = $request->input('comment_id');
        $callback = $request->input('callback');
        $comment = isset($id_comment) ? Comment::where('id', $id_comment)->first() : new Comment();
        $callback = isset($callback) ? $callback : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/comments' : '/comments/' . $id_comment;

        $data = [
            'dataModal' => [
                'commentable_id' => $request->input('commentable_id'),
                'commentable_type' => "App\\" . $request->input('commentable_type'),
                'comment' => $comment->comment,
                'id' => $id_comment,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.comment', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //see modal controller
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation du formulaire
        $this->validate($request, [
            'commentable_id' => 'required|Integer',
            'commentable_type' => 'required|String',
            'comment' => 'required|min:1|max:2000'
        ]);

        //enregistrement des données
        $comment = new Comment();
        $comment->commentable_id = $request->input('commentable_id');
        $comment->commentable_type = $request->input('commentable_type');
        $comment->comment = $request->input('comment');
        $comment->user_id = Auth::id();
        $comment->save();

        //Notification sur un post
        if($comment->commentable_type == 'App\Post') {
            $post = Post::where('id',$comment->commentable_id)->with('user')->with('postable')->first();
            if($post->user->id != Auth::id()){
                $notification = new Notification();
                $notification->user_id = $post->user->id;
                $notification->type = 'new_comment';
                $notification->data = json_encode(
                    [
                        'title'=> Auth::user()->name . ' à commenté(e) votre post sur ' . $post->postable->label,
                        'icon'=>'/img/icon-fil-actu.svg',
                        'content' => 'posté par <a href="' . route('userPage',['user_id'=>Auth::id(),'user_label'=>Auth::user()->name]) . '">' . Auth::user()->name . '</a>',
                        'action' => 'vuePost(' . $post->id . ')'
                    ]
                );
                $notification->save();
            }
        };

        //on récupère l'élément commenté au passage
        $comment = Comment::where('id', $comment->id)->with('commentable')->first();

        return response()->json(json_encode($comment));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //see modal controller
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validation du formulaire
        $this->validate($request, [
            'commentable_id' => 'required|Integer',
            'commentable_type' => 'required|String',
            'id' => 'required|Integer',
            'comment' => 'required|min:1|max:2000'
        ]);

        //enregistrement des données
        $comment = Comment::where('id', $request->input('id'))->with('commentable')->first();

        if($comment->user_id == Auth::id()){
            $comment->comment = $request->input('comment');
            $comment->save();
        }

        return response()->json(json_encode($comment));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::where('id', $id)->first();
        $oldComment = $comment;

        if($comment->user_id == Auth::id()){
            $comment->delete();
        }

        return response()->json(json_encode($oldComment));
    }

}
