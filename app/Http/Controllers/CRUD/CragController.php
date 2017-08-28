<?php

namespace App\Http\Controllers\CRUD;

use App\Crag;
use App\Orientation;
use App\Photo;
use App\Search;
use App\Season;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CragController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UNE FALAISE
    function cragModal(Request $request){

        $id = $request->input('id');
        if(isset($id)){
            $crag = Crag::where('id', $id)->with('orientation')->with('season')->first();
            $callback = 'refresh';
        }else{
            $crag = new Crag();
            $crag->lat = $request->input('lat');
            $crag->lng = $request->input('lng');
            $crag->code_country = 'NC';
            $crag->country = 'Inconnu';
            $callback = 'goToNewCrag';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/crags' : '/crags/' . $id;

        $data = [
            'dataModal' => [
                'crag' => $crag,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.crag', $data);
    }


    //MODAL DE CONFIRMATION DU BANDEAU DU SITE
    function bandeauModal(Request $request){

        $crag = Crag::where('id', $request->input('crag_id'))->first();
        $photo = Photo::where('id', $request->input('photo_id'))->first();
        $callback = 'refresh';

        $data = [
            'dataModal' => [
                'crag' => $crag,
                'photo' => $photo,
                'route' => '/bandeau/define',
                'callback' => $callback
            ]
        ];

        return view('modal.bandeau', $data);
    }

    //ENREGISTREMENT DU BANDEAU
    function defineBandeau(Request $request){
        $crag = Crag::where('id', $request->input('crag_id'))->first();
        $photo = Photo::where('id', $request->input('photo_id'))->first();
        $crag->photo_id = $photo->id;
        $crag->bandeau = '/storage/photos/crags/1300/' . $photo->slug_label;
        $crag->save();
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
        $crag = new Crag();
        $crag->label = $request->input('label');
        $crag->rock_id = $request->input('rock_id');
        $crag->code_country = $request->input('code_country');
        $crag->country = $request->input('country');
        $crag->city = $request->input('city');
        $crag->region = $request->input('region');
        $crag->user_id = Auth::id();
        $crag->lat = $request->input('lat');
        $crag->lng = $request->input('lng');
        $crag->bandeau = '/img/default-crag-bandeau.jpg';
        $crag->type_voie = 0;
        $crag->type_bloc = 0;
        $crag->type_deep_water = 0;
        $crag->type_grande_voie = 0;
        $crag->type_via_ferrata = 0;
        $crag->save();
        $crag->slug = str_slug($crag->label);

        //information sur la saison
        $season = new Season();
        $season->seasontable_id = $crag->id;
        $season->seasontable_type = 'App\Crag';
        $season->summer = $request->input('summer');
        $season->autumn = $request->input('autumn');
        $season->winter = $request->input('winter');
        $season->spring = $request->input('spring');
        $season->save();

        //information sur l'orientation
        $orientation = new Orientation();
        $orientation->orientable_id = $crag->id;
        $orientation->orientable_type = 'App\Crag';
        $orientation->north = $request->input('north');
        $orientation->east = $request->input('east');
        $orientation->south = $request->input('south');
        $orientation->west = $request->input('west');
        $orientation->north_east = $request->input('north_east');
        $orientation->north_west = $request->input('north_west');
        $orientation->south_east = $request->input('south_east');
        $orientation->south_west = $request->input('south_west');
        $orientation->save();

        //Mise à jour de l'index de recherche
        Search::index('App\Crag', $crag->id, $crag->label);

        return response()->json(json_encode($crag));
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
        $crag = Crag::where('id', $request->input('id'))->first();

        $crag->label = $request->input('label');
        $crag->city = $request->input('city');
        $crag->rock_id = $request->input('rock_id');
        $crag->region = $request->input('region');
        $crag->lat = $request->input('lat');
        $crag->lng = $request->input('lng');
        $crag->save();

        //mise à jour des données des saisons
        $season = Season::where(
            [
                ['seasontable_id', $request->input('seasontable_id')],
                ['seasontable_type', $request->input('seasontable_type')]
            ]
        )->first();

        $season->summer = $request->input('summer');
        $season->autumn = $request->input('autumn');
        $season->winter = $request->input('winter');
        $season->spring = $request->input('spring');
        $season->save();

        //mise à jour des données d'orientation
        $orientation = Orientation::where(
            [
                ['orientable_id', $request->input('orientable_id')],
                ['orientable_type', $request->input('orientable_type')]
            ]
        )->first();

        $orientation->north = $request->input('north');
        $orientation->east = $request->input('east');
        $orientation->south = $request->input('south');
        $orientation->west = $request->input('west');
        $orientation->north_east = $request->input('north_east');
        $orientation->north_west = $request->input('north_west');
        $orientation->south_east = $request->input('south_east');
        $orientation->south_west = $request->input('south_west');
        $orientation->save();

        //Mise à jour de l'index de recherche
        Search::index('App\Crag', $crag->id, $crag->label);

        return response()->json(json_encode($crag));
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
