<?php

namespace App\Http\Controllers\CRUD;

use App\Sector;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectorController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN SECTEUR
    function sectorModal(Request $request){

        $id = $request->input('id');
        if(isset($id)){
            $sector = Sector::where('id', $id)->with('orientation')->with('season')->first();
            $callback = 'refresh';
        }else{
            $sector = new Sector();
            $sector->lat = $request->input('lat');
            $sector->lng = $request->input('lng');
            $callback = 'openNewSector';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/sectors' : '/sectors/' . $id;

        $data = [
            'dataModal' => [
                'sector' => $sector,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.sector', $data);
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
            'lat' => 'required',
            'lng' => 'required',
            'label' => 'required|max:255'
        ]);

        //enregistrement des données
        $sector = new Sector();
        $sector->crag_id = $request->input('crag_id');
        $sector->lat = $request->input('lat');
        $sector->lng = $request->input('lng');
        $sector->label = $request->input('label');
        $sector->user_id = Auth::id();
        $sector->save();

        return response()->json(json_encode($sector));

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
            'lat' => 'required',
            'lng' => 'required',
            'label' => 'required|max:255'
        ]);

        //enregistrement des données
        $sector = Sector::where('id', $request->input('id'))->first();
        if($sector->user_id == Auth::id()){
            $sector->label = $request->input('label');
            $sector->lat = $request->input('lat');
            $sector->lng = $request->input('lng');
            $sector->save();
        }

        return response()->json(json_encode($sector));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sector = Sector::where('id', $id)->first();

        if($sector->user_id == Auth::id()){
            $sector->delete();
        }
    }
}
