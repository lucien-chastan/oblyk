<?php

namespace App\Http\Controllers\CRUD;

use App\Notification;
use App\Post;
use App\Route;
use Validator;
use App\Description;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DescriptionController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN ÉLEMENT
    function descriptionModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_description = $request->input('description_id');
        $callback = $request->input('callback');
        if (isset($id_description)) {
            $description = Description::where('id', $id_description)->first();
        } else {
            $description = new Description();
            $description->note = 0;
        }
        $callback = isset($callback) ? $callback : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/descriptions' : '/descriptions/' . $id_description;

        $data = [
            'dataModal' => [
                'descriptive_id' => $request->input('descriptive_id'),
                'descriptive_type' => "App\\" . $request->input('descriptive_type'),
                'description' => $description->description,
                'note' => $description->note,
                'private' => $description->private,
                'id' => $id_description,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.description', $data);
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
            'descriptive_id' => 'required|Integer',
            'descriptive_type' => 'required|String',
            'description' => 'required|min:1|max:2000'
        ]);

        //enregistrement des données
        $description = new Description();
        $description->descriptive_id = $request->input('descriptive_id');
        $description->descriptive_type = $request->input('descriptive_type');
        $description->description = $request->input('description');
        $description->note = $request->input('note');
        $description->private = $request->input('private');
        $description->user_id = Auth::id();
        $description->save();

        //si c'est sur une ligne, on met à jour la note
        if($description->descriptive_type == 'App\Route') $this->updateNote($description->descriptive_id);

        return response()->json(json_encode($description));
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
            'descriptive_id' => 'required|Integer',
            'descriptive_type' => 'required|String',
            'id' => 'required|Integer',
            'description' => 'required|min:1|max:2000'
        ]);

        //enregistrement des données
        $description = Description::where('id', $request->input('id'))->first();

        if($description->user_id == Auth::id()){
            $description->description = $request->input('description');
            $description->note = $request->input('note');
            $description->private = $request->input('private');
            $description->save();

            //si c'est sur une ligne, on met à jour la note
            if($description->descriptive_type == 'App\Route') $this->updateNote($description->descriptive_id);
        }



        return response()->json(json_encode($description));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $description = Description::where('id', $id)->first();
        $oldDescription = $description;

        if($description->user_id == Auth::id()){
            $descriptive_id = $description->descriptive_id;
            $descriptive_type = $description->descriptive_type;
            $description->delete();

            //si c'est sur une ligne, on met à jour la note
            if($descriptive_type == 'App\Route') $this->updateNote($descriptive_id);

        }

        return response()->json(json_encode($oldDescription));
    }


    //FONCTION DE MISE À JOUR DE LA NOTE ET DU NOMBRE DE NOTE
    function updateNote($route_id){

        $descriptions = Description::where([
            ['descriptive_type', '=' , 'App\Route'],
            ['descriptive_id', '=' , $route_id],
        ])->get();

        $NbNote = $somme = 0;
        foreach ($descriptions as $description){
            if($description->note != 0) {
                $NbNote++;
                $somme += $description->note;
            }
        }

        $avgNote = ($somme != 0) ? round($somme / $NbNote,0) : 0;

        $route = Route::where('id',$route_id)->first();
        $route->nb_note = $NbNote;
        $route->note = $avgNote;
        $route->save();
    }
}
