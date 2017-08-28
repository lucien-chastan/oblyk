<?php

namespace App\Http\Controllers\CRUD;

use App\Follow;
use App\ForumTopic;
use App\Route;
use App\Search;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function topicModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_topic = $request->input('topic_id');
        $topic = isset($id_topic) ? ForumTopic::where('id', $id_topic)->first() : new ForumTopic();

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/topics' : '/topics/' . $id_topic;

        $data = [
            'dataModal' => [
                'label' => $topic->label,
                'category_id' => $topic->category_id,
                'id' => $id_topic,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.topic', $data);
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
            'label' => 'required|max:255',
            'category_id' => 'required|Integer'
        ]);

        //enregistrement des données
        $topic = new ForumTopic();
        $topic->label = $request->input('label');
        $topic->category_id = $request->input('category_id');
        $topic->last_post = Carbon::now();
        $topic->user_id = Auth::id();
        $topic->save();

        $topic->location = route('topicPage',['topic_id'=>$topic->id,'topic_label'=>str_slug($topic->label)]);

        //on ajout automatiquement le topic au élément suivi par l'auteur
        $follow = new Follow();
        $follow->followed_id = $topic->id;
        $follow->followed_type = 'App\ForumTopic';
        $follow->user_id = Auth::id();
        $follow->save();

        //Mise à jour de l'index de recherche
        Search::index('App\Topic', $topic->id, $topic->label);


        return response()->json(json_encode($topic));

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
            'label' => 'required|max:255',
            'category_id' => 'required|Integer'
        ]);

        //enregistrement des données
        $topic = ForumTopic::where('id', $request->input('id'))->first();
        if($topic->user_id == Auth::id()){
            $topic->label = $request->input('label');
            $topic->category_id = $request->input('category_id');
            $topic->save();
        }

        //Mise à jour de l'index de recherche
        Search::index('App\Topic', $topic->id, $topic->label);

        return response()->json(json_encode($topic));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = ForumTopic::where('id', $id)->first();

        if($topic->user_id == Auth::id()){
            $topic->delete();
        }
    }
}
