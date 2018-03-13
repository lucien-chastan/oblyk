<?php

namespace App\Http\Controllers\CRUD;

use App\oldSearch;
use App\Word;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WordController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function wordModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_word = $request->input('word_id');
        $word = isset($id_word) ? Word::where('id', $id_word)->first() : new Word();

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/words' : '/words/' . $id_word;

        $data = [
            'dataModal' => [
                'label' => $word->label,
                'definition' => $word->definition,
                'id' => $id_word,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'callback' => $callback,
                'route' => $outputRoute
            ]
        ];

        return view('modal.word', $data);
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
            'definition' => 'required|max:255'
        ]);

        //enregistrement des données
        $word = new Word();
        $word->label = $request->input('label');
        $word->definition = $request->input('definition');
        $word->user_id = Auth::id();
        $word->save();

        //Elasticindexation
        $word->addToIndex();

        return response()->json(json_encode($word));

    }


    //Index tous les mots dans elastic search
    public function IndexElasticWord(){
        Word::addAllToIndex();
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
            'definition' => 'required'
        ]);

        //enregistrement des données
        $word = Word::where('id', $request->input('id'))->first();
        if($word->user_id == Auth::id()){
            $word->label = $request->input('label');
            $word->definition = $request->input('definition');
            $word->save();

            //Elasticindexation
            $word->addToIndex();

        }

        return response()->json(json_encode($word));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $word = Word::where('id', $id)->first();

        if($word->user_id == Auth::id()){
            $word->delete();
        }
    }
}
