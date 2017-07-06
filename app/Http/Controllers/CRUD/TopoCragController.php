<?php

namespace App\Http\Controllers\CRUD;

use App\TopoCrag;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopoCragController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function topoCragModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_topo_crag = $request->input('topo_id');
        $topo_crag = isset($id_topo_crag) ? TopoCrag::where('id', $id_topo_crag)->first() : new TopoCrag();
        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/topoCrags' : '/topoCrags/' . $id_topo_crag;

        $data = [
            'dataModal' => [
                'crag_id' => $topo_crag->crag_id,
                'topo_id' => $topo_crag->topo_id,
                'id' => $id_topo_crag,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.topoCrag', $data);
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
        $topo_crag = new TopoCrag();
        $topo_crag->topo_id = $request->input('topo_id');
        $topo_crag->crag_id = $request->input('crag_id');
        $topo_crag->user_id = Auth::id();
        $topo_crag->save();

        return response()->json(json_encode($topo_crag));

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

        //enregistrement des données
        $topo_crag = TopoCrag::where('id', $request->input('id'))->first();
        if($topo_crag->user_id == Auth::id()){
            $topo_crag->topo_id = $request->input('topo_id');
            $topo_crag->crag_id = $request->input('crag_id');
            $topo_crag->save();
        }

        return response()->json(json_encode($topo_crag));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topo_crag = TopoCrag::where('id', $id)->first();

        if($topo_crag->user_id == Auth::id()){
            $topo_crag->delete();
        }
    }
}
