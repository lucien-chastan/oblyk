<?php

namespace App\Http\Controllers\CRUD;

use App\TopoSale;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopoSaleController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function topoSaleModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_topo_sale = $request->input('id');
        if (isset($id_topo_sale)) {
            $topo_sale = TopoSale::where('id', $id_topo_sale)->first();
        } else {
            $topo_sale = new TopoSale();
            $topo_sale->topo_id = $request->input('topo_id');
        }
        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/topoSales' : '/topoSales/' . $id_topo_sale;

        $data = [
            'dataModal' => [
                'label' => $topo_sale->label,
                'description' => $topo_sale->description,
                'url' => $topo_sale->url,
                'lat' => $topo_sale->lat,
                'lng' => $topo_sale->lng,
                'id' => $id_topo_sale,
                'topo_id' => $topo_sale->topo_id,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.topoSale', $data);
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
        $topo_sale = new TopoSale();
        $topo_sale->label = $request->input('label');
        $topo_sale->description = $request->input('description');
        $topo_sale->topo_id = $request->input('topo_id');
        $topo_sale->url = $request->input('url');
        $topo_sale->lat = $request->input('lat');
        $topo_sale->lng = $request->input('lng');
        $topo_sale->user_id = Auth::id();
        $topo_sale->save();

        return response()->json(json_encode($topo_sale));

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
        $topo_sale = TopoSale::where('id', $request->input('id'))->first();
        if($topo_sale->user_id == Auth::id()){
            $topo_sale->label = $request->input('label');
            $topo_sale->description = $request->input('description');
            $topo_sale->url = $request->input('url');
            $topo_sale->lat = $request->input('lat');
            $topo_sale->lng = $request->input('lng');
            $topo_sale->save();
        }

        return response()->json(json_encode($topo_sale));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topo = TopoSale::where('id', $id)->first();

        if($topo->user_id == Auth::id()){
            $topo->delete();
        }
    }
}
