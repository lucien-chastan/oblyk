<?php

namespace App\Http\Controllers\CRUD;

use App\User;
use App\UserPlace;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function partnerModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_partner = $request->input('place_id');
        if (isset($id_partner)) {
            $partner = UserPlace::where('id', $id_partner)->first();
        } else {
            $partner = new UserPlace();
            $partner->rayon = 5;
        }

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/partners' : '/partners/' . $id_partner;

        $data = [
            'dataModal' => [
                'label' => $partner->label,
                'description' => $partner->description,
                'lat' => $partner->lat,
                'lng' => $partner->lng,
                'rayon' => $partner->rayon,
                'id' => $id_partner,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.userPlace', $data);
    }


    function activePartner(Request $request){

        $user = User::where('id', Auth::id())->with('settings')->first();
        $user->settings->partenaire = $request->input('active');
        $user->settings->save();

        $message = $user->settings->partenaire == 1 ? 'Recherche de partenaire activée' : 'Recherche de partenaire désactivée';

        return response()->json($message);

    }

    function activePlace(Request $request){

        $place = UserPlace::where('id', $request->input('place_id'))->first();
        if($place->user_id == Auth::id()){
            $place->active = $request->input('active');
            $place->save();
        }

        $message = $place->active == 1 ? $place->label . ' activé' : $place->label . ' désactivé';

        return response()->json($message);

    }

    function mapPlaces(){
        return response()->json([
            UserPlace::where([['user_id', Auth::id()],['active', 1]])->get()
        ]);
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
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'label' => 'required|max:255',
            'rayon' => 'required|max:40|min:1|Integer'
        ]);

        //enregistrement des données
        $partner = new UserPlace();
        $partner->lat = $request->input('lat');
        $partner->lng = $request->input('lng');
        $partner->rayon = $request->input('rayon');
        $partner->label = $request->input('label');
        $partner->description = $request->input('description');
        $partner->user_id = Auth::id();
        $partner->active = 1;
        $partner->save();

        return response()->json(json_encode($partner));

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
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'label' => 'required|max:255',
            'rayon' => 'required|max:40|min:1|Integer'
        ]);

        //enregistrement des données
        $partner = UserPlace::where('id', $request->input('id'))->first();
        if($partner->user_id == Auth::id()){
            $partner->lat = $request->input('lat');
            $partner->lng = $request->input('lng');
            $partner->rayon = $request->input('rayon');
            $partner->description = $request->input('description');
            $partner->label = $request->input('label');
            $partner->save();
        }

        return response()->json(json_encode($partner));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = UserPlace::where('id', $id)->first();

        if($partner->user_id == Auth::id()){
            $partner->delete();
        }
    }
}
