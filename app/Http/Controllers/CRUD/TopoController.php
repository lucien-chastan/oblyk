<?php

namespace App\Http\Controllers\CRUD;

use App\Topo;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopoController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function topoModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_topo = $request->input('topo_id');
        $topo = isset($id_topo) ? Topo::where('id', $id_topo)->first() : new Topo();
        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/topos' : '/topos/' . $id_topo;

        $data = [
            'dataModal' => [
                'label' => $topo->label,
                'author' => $topo->author,
                'editor' => $topo->editor,
                'editionYear' => $topo->editionYear,
                'price' => $topo->price,
                'id' => $id_topo,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.topo', $data);
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
        $topo = new Topo();
        $topo->label = $request->input('label');
        $topo->author = $request->input('author');
        $topo->editor = $request->input('editor');
        $topo->editionYear = $request->input('editionYear');
        $topo->price = $request->input('price');
        $topo->user_id = Auth::id();
        $topo->save();

        return response()->json(json_encode($topo));

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
        $topo = Topo::where('id', $request->input('id'))->first();
        if($topo->user_id == Auth::id()){
            $topo->label = $request->input('label');
            $topo->author = $request->input('author');
            $topo->editor = $request->input('editor');
            $topo->editionYear = $request->input('editionYear');
            $topo->price = $request->input('price');
            $topo->save();
        }

        return response()->json(json_encode($topo));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topo = Topo::where('id', $id)->first();

        if($topo->user_id == Auth::id()){
            $topo->delete();
        }
    }
}
