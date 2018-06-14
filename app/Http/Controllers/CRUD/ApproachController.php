<?php

namespace App\Http\Controllers\CRUD;

use App\Approach;
use App\Crag;
use App\Parking;
use App\Sector;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApproachController extends Controller
{
    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN PARKING
    function approachModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_approach = $request->input('approach_id');
        if (isset($id_approach)) {
            $approach = Approach::where('id', $id_approach)->first();
        } else {
            $approach = new Approach();
            $approach->polyline = "[" . $request->input('lat1') . "," . $request->input('lng1') ."], [" . $request->input('lat2') . "," . $request->input('lng2') . "]";
            $approach->length = 0;
        }

        //On va chercher les secteurs du site
        $sectors = Sector::where('crag_id', $request->input('crag_id'))->where('lat', '!=', 0)->where('lng', '!=', 0)->get();
        $parkings = Parking::where('crag_id', $request->input('crag_id'))->where('lat', '!=', 0)->where('lng', '!=', 0)->get();
        $crag = Crag::where('id', $request->input('crag_id'))->first();

        $elements = [];
        foreach ($sectors as $sector) $elements[] = ['label'=>"Secteur : $sector->label" ,'lat'=>$sector->lat, 'lng'=>$sector->lng, 'type'=>"sector"];
        foreach ($parkings as $parking) $elements[] = ['label'=>'Parking','lat'=>$parking->lat, 'lng'=>$parking->lng, 'type'=>"parking"];
        $elements[] = ['label'=>"Site : $crag->label",'lat'=>$crag->lat, 'lng'=>$crag->lng, 'type'=>"crag"];

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvegarde
        $outputRoute = ($request->input('method') == 'POST')? '/approaches' : '/approaches/' . $id_approach;

        $data = [
            'dataModal' => [
                'crag_id' => $request->input('crag_id'),
                'polyline' => $approach->polyline,
                'description' => $approach->description,
                'length' => $approach->length,
                'elements' => json_encode($elements),
                'id' => $id_approach,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.approach', $data);
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
            'polyline' => 'required',
            'length' => 'required',
        ]);

        //enregistrement des données
        $approach = new Approach();
        $approach->description = $request->input('description');
        $approach->crag_id = $request->input('crag_id');
        $approach->polyline = $request->input('polyline');
        $approach->length = $request->input('length');
        $approach->user_id = Auth::id();
        $approach->save();

        return response()->json(json_encode($approach));

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
            'polyline' => 'required',
            'length' => 'required',
        ]);

        //enregistrement des données
        $approach = Approach::where('id', $request->input('id'))->first();
        if($approach->user_id == Auth::id()){
            $approach->description = $request->input('description');
            $approach->polyline = $request->input('polyline');
            $approach->length = $request->input('length');
            $approach->save();
        }

        return response()->json(json_encode($approach));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $approach = Approach::where('id', $id)->first();

        if($approach->user_id == Auth::id()){
            $approach->delete();
        }
    }
}
