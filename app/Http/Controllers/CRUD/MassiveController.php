<?php

namespace App\Http\Controllers\CRUD;

use App\Massive;
use App\MassiveCrag;
use App\oldSearch;
use Intervention\Image\Facades\Image;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MassiveController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function massiveModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_massive = $request->input('massive_id');
        $massive = isset($id_massive) ? Massive::where('id', $id_massive)->first() : new Massive();

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        $crag_id = $request->input('crag_id');
        $crag_id = isset($crag_id) ? $request->input('crag_id') : '';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/massives' : '/massives/' . $id_massive;

        $data = [
            'dataModal' => [
                'label' => $massive->label,
                'id' => $id_massive,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'crag_id' => $crag_id,
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.massive', $data);
    }


    //Index tous dans elastic search
    public function IndexElasticMassive(){
        Massive::addAllToIndex();
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
        ]);

        //enregistrement des données
        $massive = new Massive();
        $massive->label = $request->input('label');
        $massive->user_id = Auth::id();
        $massive->save();
        $massive->slug_label = str_slug($massive->label);

        if($request->input('crag_id') != ''){
            $liaison = new MassiveCrag();
            $liaison->user_id = Auth::id();
            $liaison->massive_id = $massive->id;
            $liaison->crag_id = $request->input('crag_id');
            $liaison->save();
        }

        //Elastic indexation
        $massive->addToIndex();

        return response()->json(json_encode($massive));

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
        ]);

        //enregistrement des données
        $massive = Massive::where('id', $request->input('id'))->first();
        $massive->label = $request->input('label');
        $massive->save();

        //Elastic indexation
        $massive->addToIndex();


        return response()->json(json_encode($massive));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $massive = Massive::where('id', $id)->first();

        if($massive->user_id == Auth::id()){
            $massive->removeFromIndex();
            $massive->delete();
        }
    }

}
