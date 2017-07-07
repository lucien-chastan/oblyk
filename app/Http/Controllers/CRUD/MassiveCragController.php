<?php

namespace App\Http\Controllers\CRUD;

use App\Crag;
use App\Massive;
use App\MassiveCrag;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MassiveCragController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function massiveCragModal(Request $request){

        $data = [
            'dataModal' => [
                'crag_id' => $request->input('crag_id'),
                'title' => $request->input('title'),
                'lat' => $request->input('lat'),
                'lng' => $request->input('lng'),
                'rayon' => $request->input('rayon'),
            ]
        ];

        return view('modal.massiveCrag', $data);
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
        $massive_crag = new MassiveCrag();
        $massive_crag->massive_id = $request->input('massive_id');
        $massive_crag->crag_id = $request->input('crag_id');
        $massive_crag->user_id = Auth::id();
        $massive_crag->save();

        return response()->json(json_encode($massive_crag));

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
        $massive_crag = MassiveCrag::where('id', $request->input('id'))->first();
        if($massive_crag->user_id == Auth::id()){
            $massive_crag->massive_id = $request->input('massive_id');
            $massive_crag->crag_id = $request->input('crag_id');
            $massive_crag->save();
        }

        return response()->json(json_encode($massive_crag));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $massive_crag = MassiveCrag::where('id', $id)->first();

        if($massive_crag->user_id == Auth::id()){
            $massive_crag->delete();
        }
    }

    function createLiaison(Request $request){
        $massive = Massive::where('id', $request->input('massive_id'))->first();
        $crag = Crag::where('id', $request->input('crag_id'))->first();
        $massive->slug_label = str_slug($massive->label);

        $liaison = new MassiveCrag();
        $liaison->crag_id = $crag->id;
        $liaison->massive_id = $massive->id;
        $liaison->user_id = Auth::id();
        $liaison->save();

        $data = [
            'crag' => $crag,
            'massive' => $massive,
            'liaison' => $liaison
        ];

        return response()->json($data);
    }

    function deleteLiaison(Request $request){
        $liaison = MassiveCrag::where('id', $request->input('id'))->first();
        $liaison->delete();
    }
}
