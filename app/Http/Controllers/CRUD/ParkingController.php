<?php

namespace App\Http\Controllers\CRUD;

use App\Parking;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN PARKING
    function parkingModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_parking = $request->input('parking_id');
        if (isset($id_parking)) {
            $parking = Parking::where('id', $id_parking)->first();
        } else {
            $parking = new Parking();
            $parking->lat = $request->input('lat');
            $parking->lng = $request->input('lng');
        }

        //définition du chemin de sauvegarde
        $outputRoute = ($request->input('method') == 'POST')? '/parkings' : '/parkings/' . $id_parking;

        $data = [
            'dataModal' => [
                'crag_id' => $request->input('crag_id'),
                'lat' => $parking->lat,
                'lng' => $parking->lng,
                'description' => $parking->description,
                'id' => $id_parking,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute
            ]
        ];

        return view('modal.parking', $data);
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
            'lat' => 'required',
            'lng' => 'required'
        ]);

        //enregistrement des données
        $parking = new Parking();
        $parking->description = $request->input('description');
        $parking->crag_id = $request->input('crag_id');
        $parking->lat = $request->input('lat');
        $parking->lng = $request->input('lng');
        $parking->user_id = Auth::id();
        $parking->save();

        return response()->json(json_encode($parking));

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
            'lat' => 'required',
            'lng' => 'required'
        ]);

        //enregistrement des données
        $parking = Parking::where('id', $request->input('id'))->first();
        if($parking->user_id == Auth::id()){
            $parking->description = $request->input('description');
            $parking->lat = $request->input('lat');
            $parking->lng = $request->input('lng');
            $parking->save();
        }

        return response()->json(json_encode($parking));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parking = Parking::where('id', $id)->first();

        if($parking->user_id == Auth::id()){
            $parking->delete();
        }
    }
}
