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
        $description = isset($id_description) ? Description::where('id', $id_description)->first() : new Description();

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/descriptions' : '/descriptions/' . $id_description;

        $data = [
            'dataModal' => [
                'crag_id' => $request->input('crag_id'),
                'description' => $description->description,
                'id' => $id_description,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute
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

        if($description->user_id == Auth::id()){
            $description->delete();
        }
    }
}
