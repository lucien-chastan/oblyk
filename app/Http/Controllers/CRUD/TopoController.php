<?php

namespace App\Http\Controllers\CRUD;

use App\Crag;
use App\oldSearch;
use App\Topo;
use App\TopoCrag;
use Intervention\Image\Facades\Image;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopoController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function topoModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_topo = $request->input('topo_id');
        $topo = isset($id_topo) ? Topo::where('id', $id_topo)->first() : new Topo();

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        $crag_id = $request->input('crag_id');
        $crag_id = isset($crag_id) ? $request->input('crag_id') : '';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/topos' : '/topos/' . $id_topo;

        $data = [
            'dataModal' => [
                'label' => $topo->label,
                'author' => $topo->author,
                'editor' => $topo->editor,
                'editionYear' => $topo->editionYear,
                'price' => $topo->price,
                'page' => $topo->page,
                'weight' => $topo->weight,
                'id' => $id_topo,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'crag_id' => $crag_id,
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.topo', $data);
    }


    //AFFICHE LA MODAL POUR UPLOADER UNE COUVERTURE
    function topoCouvertureModal(Request $request){
        $id_topo = $request->input('topo_id');

        $data = [
            'dataModal' => [
                'topo_id' => $id_topo,
                'title' => $request->input('title'),
            ]
        ];

        return view('modal.topoCouverture', $data);
    }


    //FONCTION POUR UPLOADER UNE CONVERTURE
    function uploadCouvertureTopo(Request $request){

        $topo_id = $request->input('topo_id');

        if ($request->hasFile('file')) {

            //Image en 700px de haut
            Image::make($request->file('file'))
                ->orientate()
                ->resize(null, 700, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg', 85)
                ->save(storage_path('app/public/topos/700/topo-' . $topo_id . '.jpg'));

            //Image en 200px de haut
            Image::make($request->file('file'))
                ->orientate()
                ->resize(null, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg', 85)
                ->save(storage_path('app/public/topos/200/topo-' . $topo_id . '.jpg'));

            //Image en 100px de haut
            Image::make($request->file('file'))
                ->orientate()
                ->resize(null, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg', 75)
                ->save(storage_path('app/public/topos/100/topo-' . $topo_id . '.jpg'));

            //Image en 50px de haut
            Image::make($request->file('file'))
                ->orientate()
                ->resize(null, 50, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg', 75)
                ->save(storage_path('app/public/topos/50/topo-' . $topo_id . '.jpg'));
        }

    }


    //Index tous dans elastic search
    public function IndexElasticTopo(){
        Topo::addAllToIndex();
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
        $topo = new Topo();
        $topo->label = $request->input('label');
        $topo->author = $request->input('author');
        $topo->editor = $request->input('editor');
        $topo->editionYear = $request->input('editionYear');
        $topo->price = $request->input('price');
        $topo->page = $request->input('page');
        $topo->weight = $request->input('weight');
        $topo->user_id = Auth::id();
        $topo->save();
        $topo->slug_label = str_slug($topo->label);

        if($request->input('crag_id') != ''){
            $liaison = new TopoCrag();
            $liaison->user_id = Auth::id();
            $liaison->topo_id = $topo->id;
            $liaison->crag_id = $request->input('crag_id');
            $liaison->save();
        }

        //Elastic indexation
        $topo->addToIndex();

        return response()->json(json_encode($topo));

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
        $topo = Topo::where('id', $request->input('id'))->first();
        $topo->label = $request->input('label');
        $topo->author = $request->input('author');
        $topo->editor = $request->input('editor');
        $topo->editionYear = $request->input('editionYear');
        $topo->price = $request->input('price');
        $topo->page = $request->input('page');
        $topo->weight = $request->input('weight');
        $topo->save();

        //Elastic indexation
        $topo->addToIndex();


        return response()->json(json_encode($topo));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topo = Topo::where('id', $id)->first();

        if($topo->user_id == Auth::id()){
            $topo->removeFromIndex();
            $topo->delete();
        }
    }

}
