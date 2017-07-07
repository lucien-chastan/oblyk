<?php

namespace App\Http\Controllers\CRUD;

use App\TopoWeb;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopoWebController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function topoWebModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_topo_web = $request->input('topo_web_id');
        if (isset($id_topo_web)) {
            $topoWeb = TopoWeb::where('id', $id_topo_web)->first();
        } else {
            $topoWeb = new TopoWeb();
            $topoWeb->crag_id = $request->input('crag_id');
        }

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/topoWebs' : '/topoWebs/' . $id_topo_web;

        $data = [
            'dataModal' => [
                'label' => $topoWeb->label,
                'crag_id' => $topoWeb->crag_id,
                'url' => $topoWeb->url,
                'id' => $id_topo_web,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'callback' => $callback,
                'route' => $outputRoute
            ]
        ];

        return view('modal.topoWeb', $data);
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
            'url' => 'required|max:255',
        ]);

        //enregistrement des données
        $topoWeb = new TopoWeb();
        $topoWeb->crag_id = $request->input('crag_id');
        $topoWeb->label = $request->input('label');
        $topoWeb->url = $request->input('url');
        $topoWeb->user_id = Auth::id();
        $topoWeb->save();

        return response()->json(json_encode($topoWeb));

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
            'url' => 'required|max:255'
        ]);

        //enregistrement des données
        $topoWeb = TopoWeb::where('id', $request->input('id'))->first();
        if($topoWeb->user_id == Auth::id()){
            $topoWeb->label = $request->input('label');
            $topoWeb->url = $request->input('url');
            $topoWeb->save();
        }

        return response()->json(json_encode($topoWeb));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topoWeb = TopoWeb::where('id', $id)->first();

        if($topoWeb->user_id == Auth::id()){
            $topoWeb->delete();
        }
    }
}
