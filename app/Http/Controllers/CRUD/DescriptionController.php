<?php

namespace App\Http\Controllers\CRUD;

use Validator;
use App\Description;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DescriptionController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN ÉLEMENT
    function descriptionModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_description = $request->input('description_id');
        $callback = $request->input('callback');
        if (isset($id_description)) {
            $description = Description::where('id', $id_description)->first();
        } else {
            $description = new Description();
            $description->note = 0;
        }
        $callback = isset($callback) ? $callback : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/descriptions' : '/descriptions/' . $id_description;

        $data = [
            'dataModal' => [
                'descriptive_id' => $request->input('descriptive_id'),
                'descriptive_type' => "App\\" . $request->input('descriptive_type'),
                'description' => $description->description,
                'note' => $description->note,
                'id' => $id_description,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.description', $data);
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
            'descriptive_id' => 'required|Integer',
            'descriptive_type' => 'required|String',
            'description' => 'required|min:1|max:2000'
        ]);

        //enregistrement des données
        $description = new Description();
        $description->descriptive_id = $request->input('descriptive_id');
        $description->descriptive_type = $request->input('descriptive_type');
        $description->description = $request->input('description');
        $description->note = $request->input('note');
        $description->user_id = Auth::id();
        $description->save();

        return response()->json(json_encode($description));
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
            'descriptive_id' => 'required|Integer',
            'descriptive_type' => 'required|String',
            'id' => 'required|Integer',
            'description' => 'required|min:1|max:2000'
        ]);

        //enregistrement des données
        $description = Description::where('id', $request->input('id'))->first();

        if($description->user_id == Auth::id()){
            $description->description = $request->input('description');
            $description->note = $request->input('note');
            $description->save();
        }

        return response()->json(json_encode($description));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $description = Description::where('id', $id)->first();
        $oldDescription = $description;

        if($description->user_id == Auth::id()){
            $description->delete();
        }

        return response()->json(json_encode($oldDescription));
    }
}
