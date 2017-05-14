<?php

namespace App\Http\Controllers\CRUD;

use App\Sector;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectorController extends Controller
{
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
