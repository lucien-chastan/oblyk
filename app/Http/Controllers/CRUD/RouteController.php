<?php

namespace App\Http\Controllers\CRUD;

use App\Route;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UNE FALAISE
    function routeModal(Request $request){

        $id = $request->input('id');
        if(isset($id)){
            $route = Route::where('id', $id)->with('routeSections')->first();
            $callback = 'refresh';
        }else{

            //créer une fausse section de ligne
            $routeSections = new class{};
            $routeSections->nb_point = 0;
            $routeSections->point_id = 1;
            $routeSections->anchor_id = 1;
            $routeSections->incline_id = 1;
            $routeSections->reception_id = 1;
            $routeSections->start_id = 1;

            $route = new Route();
            $route->crag_id = $request->input('crag_id');
            $route->sector_id = $request->input('sector_id');
            $route->routeSections = [$routeSections];
            $route->nb_longueur = 1;
            $callback = 'refresh';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/routes' : '/routes/' . $id;

        $data = [
            'dataModal' => [
                'ligne' => $route,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.route', $data);
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
            'label' => 'required|String|max:255',
        ]);

        //information sur la falaise
        $route = new Route();
        $route->save();

        return response()->json(json_encode($route));
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
            'label' => 'required|String|max:255',
        ]);

        //mise à jour des données de la falaise
        $route = Route::where('id', $request->input('id'))->first();

        $route->label = $request->input('label');
        $route->save();

        return response()->json(json_encode($route));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
