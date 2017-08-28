<?php

namespace App\Http\Controllers\CRUD;

use App\Gym;
use App\Search;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GymController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UNE SALLE
    function gymModal(Request $request){

        $id = $request->input('id');
        if(isset($id)){
            $gym = Gym::where('id', $id)->first();
            $callback = 'refresh';
        }else{
            $gym = new Gym();
            $gym->lat = $request->input('lat');
            $gym->lng = $request->input('lng');
            $gym->code_country = 'NC';
            $gym->country = 'Inconnu';
            $callback = 'goToNewGym';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/gyms' : '/gyms/' . $id;

        $data = [
            'dataModal' => [
                'gym' => $gym,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.gym', $data);
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
            'city' => 'required|String|max:255',
            'region' => 'required|String|max:255'
        ]);

        //information sur la falaise
        $gym = new Gym();
        $gym->user_id = Auth::id();
        $gym->label = $request->input('label');
        $gym->description = $request->input('description');
        $gym->type_boulder = $request->input('type_boulder');
        $gym->type_route = $request->input('type_route');
        $gym->free = 1;
        $gym->address = $request->input('address');
        $gym->postal_code = $request->input('postal_code');
        $gym->code_country = $request->input('code_country');
        $gym->country = $request->input('country');
        $gym->city = $request->input('city');
        $gym->big_city = $request->input('big_city');
        $gym->region = $request->input('region');
        $gym->lat = $request->input('lat');
        $gym->lng = $request->input('lng');
        $gym->email = $request->input('email');
        $gym->phone_number = $request->input('phone_number');
        $gym->web_site = $request->input('web_site');
        $gym->save();
        $gym->slug = str_slug($gym->label);

        //Mise à jour de l'index de recherche
        Search::index('App\Gym', $gym->id, $gym->label);

        return response()->json(json_encode($gym));
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
            'city' => 'required|String|max:255',
            'region' => 'required|String|max:255'
        ]);

        //mise à jour des données de la falaise
        $gym = Gym::where('id', $request->input('id'))->first();

        $gym->label = $request->input('label');
        $gym->description = $request->input('description');
        $gym->type_boulder = $request->input('type_boulder');
        $gym->type_route = $request->input('type_route');
        $gym->address = $request->input('address');
        $gym->postal_code = $request->input('postal_code');
        $gym->city = $request->input('city');
        $gym->big_city = $request->input('big_city');
        $gym->region = $request->input('region');
        $gym->email = $request->input('email');
        $gym->phone_number = $request->input('phone_number');
        $gym->web_site = $request->input('web_site');
        $gym->lat = $request->input('lat');
        $gym->lng = $request->input('lng');
        $gym->save();

        //Mise à jour de l'index de recherche
        Search::index('App\Gym', $gym->id, $gym->label);

        return response()->json(json_encode($gym));
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
