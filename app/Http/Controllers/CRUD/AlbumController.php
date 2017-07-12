<?php

namespace App\Http\Controllers\CRUD;

use App\Album;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function albumModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_album = $request->input('album_id');
        $album = isset($id_album) ? Album::where('id', $id_album)->first() : new Album();

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/albums' : '/albums/' . $id_album;

        $data = [
            'dataModal' => [
                'label' => $album->label,
                'description' => $album->description,
                'id' => $id_album,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'callback' => $callback,
                'route' => $outputRoute
            ]
        ];

        return view('modal.album', $data);
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
        $album = new Album();
        $album->label = $request->input('label');
        $album->description = $request->input('description');
        $album->user_id = Auth::id();
        $album->save();

        return response()->json(json_encode($album));

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
        $album = Album::where('id', $request->input('id'))->first();
        if($album->user_id == Auth::id()){
            $album->description = $request->input('description');
            $album->label = $request->input('label');
            $album->save();
        }

        return response()->json(json_encode($album));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::where('id', $id)->first();

        if($album->user_id == Auth::id()){
            $album->delete();
        }
    }
}
