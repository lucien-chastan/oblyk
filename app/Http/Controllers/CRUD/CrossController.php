<?php

namespace App\Http\Controllers\CRUD;

use App\Cross;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CrossController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function crossModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_cross = $request->input('cross_id');
        if (isset($id_cross)) {
            $cross = Cross::where('id', $id_cross)->first();
            $route_id = $cross->route_id;
        } else {
            $cross = new Cross();
            $route_id = $request->input('route_id');
        }

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/crosses' : '/crosses/' . $id_cross;

        $data = [
            'dataModal' => [
                'route_id' => $route_id,
                'status_id' => $cross->status_id,
                'environment' => $cross->environment,
                'release_at' => $cross->release_at,
                'id' => $id_cross,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.cross', $data);
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

        //enregistrement des données
        $cross = new Cross();
        $cross->route_id = $request->input('route_id');
        $cross->status_id = $request->input('status_id');
        $cross->environment = $request->input('environment');
        $cross->release_at = $request->input('release_at');
        $cross->user_id = Auth::id();
        $cross->save();

        return response()->json(json_encode($cross));

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
        $cross = Cross::where('id', $request->input('id'))->first();
        if($cross->user_id == Auth::id()){
            $cross->status_id = $request->input('status_id');
            $cross->release_at = $request->input('release_at');
            $cross->save();
        }

        return response()->json(json_encode($cross));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cross = Cross::where('id', $id)->first();

        if($cross->user_id == Auth::id()){
            $cross->delete();
        }
    }

}
