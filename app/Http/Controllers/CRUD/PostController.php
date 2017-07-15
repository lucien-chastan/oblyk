<?php

namespace App\Http\Controllers\CRUD;

use App\Post;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function postModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_post = $request->input('post_id');
        $post = isset($id_post) ? Post::where('id', $id_post)->first() : new Post();

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/posts' : '/posts/' . $id_post;

        $data = [
            'dataModal' => [
                'postable_id' => $request->input('postable_id'),
                'postable_type' => "App\\" . $request->input('postable_type'),
                'content' => $post->content,
                'id' => $id_post,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.post', $data);
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
            'postable_id' => 'required|Integer',
            'postable_type' => 'required|String',
            'content' => 'required',
        ]);

        //enregistrement des données
        $post = new Post();
        $post->postable_id = $request->input('postable_id');
        $post->postable_type = $request->input('postable_type');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        $post->save();

        return response()->json(json_encode($post));

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
            'postable_id' => 'required|Integer',
            'postable_type' => 'required|String',
            'content' => 'required',
        ]);

        //enregistrement des données
        $post = Post::where('id', $request->input('id'))->first();
        if($post->user_id == Auth::id()){
            $post->content = $request->input('content');
            $post->save();
        }

        return response()->json(json_encode($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();

        if($post->user_id == Auth::id()){
            $post->delete();
        }
    }
}
