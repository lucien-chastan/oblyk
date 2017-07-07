<?php

namespace App\Http\Controllers\CRUD;

use App\Crag;
use App\Topo;
use App\TopoCrag;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopoCragController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function topoCragModal(Request $request){

        $data = [
            'dataModal' => [
                'crag_id' => $request->input('crag_id'),
                'title' => $request->input('title'),
                'lat' => $request->input('lat'),
                'lng' => $request->input('lng'),
                'rayon' => $request->input('rayon'),
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

    function createLiaison(Request $request){
        $topo = Topo::where('id', $request->input('topo_id'))->first();
        $crag = Crag::where('id', $request->input('crag_id'))->first();
        $topo->slug_label = str_slug($topo->label);

        $liaison = new TopoCrag();
        $liaison->crag_id = $crag->id;
        $liaison->topo_id = $topo->id;
        $liaison->user_id = Auth::id();
        $liaison->save();

        $data = [
            'crag' => $crag,
            'topo' => $topo,
            'liaison' => $liaison
        ];

        return response()->json($data);
    }

    function deleteLiaison(Request $request){
        $liaison = TopoCrag::where('id', $request->input('id'))->first();
        $liaison->delete();
    }
}
