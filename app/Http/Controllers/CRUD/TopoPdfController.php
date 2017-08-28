<?php

namespace App\Http\Controllers\CRUD;

use App\Crag;
use App\Search;
use App\TopoPdf;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopoPdfController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function TopoPdfModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_topo_pdf = $request->input('topo_pdf_id');
        if (isset($id_topo_pdf)) {
            $topoPdf = TopoPdf::where('id', $id_topo_pdf)->first();
        } else {
            $topoPdf = new TopoPdf();
            $topoPdf->crag_id = $request->input('crag_id');
        }
        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';


        //définition du chemin de sauvgarde
        if (($request->input('method') == 'POST')) {
            $outputRoute = '/topoPdfs';
            $submitFunction = 'uploadTopoPdf';
        } else {
            $outputRoute = '/topoPdfs/' . $id_topo_pdf;
            $submitFunction = 'submitData';
        }

        $data = [
            'dataModal' => [
                'crag_id' => $topoPdf->crag_id,
                'slug_label' => $topoPdf->slug_label,
                'description' => $topoPdf->description,
                'author' => $topoPdf->author,
                'label' => $topoPdf->label,
                'id' => $id_topo_pdf,
                'submit' => $submitFunction,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'callback' => $callback,
                'route' => $outputRoute
            ]
        ];

        return view('modal.topoPdf', $data);
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

        $topoPdf = [];

        //si nous avons un fichier image
        if ($request->hasFile('file')) {

            if($request->file('file')->getMimeType() == 'application/pdf'){

                $crag = Crag::where('id', $request->input('crag_id'))->first();

                $topoPdf = new TopoPdf();
                $topoPdf->crag_id = $request->input('crag_id');
                $topoPdf->slug_label = 'temp.pdf';
                $topoPdf->label = $request->input('label');
                $topoPdf->description = $request->input('description');
                $topoPdf->author = $request->input('author');
                $topoPdf->user_id = Auth::id();
                $topoPdf->save();

                //on enregitre le nom du PDF (avec l'identifiant)
                $topoPdf->slug_label = str_slug($crag->label) . '-' . $topoPdf->id . '.pdf';
                $topoPdf->save();

                $request->file('file')->storeAs('public/topos/PDF/', $topoPdf->slug_label);

                //Mise à jour de l'index de recherche
                Search::index('App\TopoPdf', $topoPdf->id, $topoPdf->label);

            }
        }

        return response()->json(json_encode($topoPdf));
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
        $topoPdf = TopoPdf::where('id', $request->input('id'))->first();

        if($topoPdf->user_id == Auth::id()){
            $topoPdf->description = $request->input('description');
            $topoPdf->author = $request->input('author');
            $topoPdf->label = $request->input('label');
            $topoPdf->save();

            //Mise à jour de l'index de recherche
            Search::index('App\TopoPdf', $topoPdf->id, $topoPdf->label);

        }

        return response()->json(json_encode($topoPdf));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $topoPdf = TopoPdf::where('id', $id)->first();
        $saveTopoPdf = $topoPdf;

        if($topoPdf->user_id == Auth::id()){

            //suppression du PDF dans le storage
            Storage::delete(['public/topos/PDF/' . $topoPdf->slug_label]);

            $topoPdf->delete();
        }

        return response()->json(json_encode($saveTopoPdf));
    }
}
