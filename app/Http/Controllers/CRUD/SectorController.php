<?php

namespace App\Http\Controllers\CRUD;

use App\Orientation;
use App\Season;
use App\Sector;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectorController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN SECTEUR
    function sectorModal(Request $request){

        $id = $request->input('id');
        if(isset($id)){
            $sector = Sector::where('id', $id)->with('orientation')->with('season')->first();
            $callback = 'reloadSector';
        }else{
            $sector = new Sector();
            $sector->crag_id = $request->input('crag_id');
            $sector->lat = 0;
            $sector->lng = 0;
            $callback = 'reloadSector';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/sectors' : '/sectors/' . $id;

        $data = [
            'dataModal' => [
                'sector' => $sector,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.sector', $data);
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
            'lat' => 'required',
            'lng' => 'required',
            'label' => 'required|max:255'
        ]);

        //enregistrement des données
        $sector = new Sector();
        $sector->crag_id = $request->input('crag_id');
        $sector->lat = $request->input('lat');
        $sector->lng = $request->input('lng');
        $sector->label = $request->input('label');
        $sector->approach = $request->input('approach');
        $sector->rain_id = $request->input('rain_id');
        $sector->sun_id = $request->input('sun_id');
        $sector->user_id = Auth::id();
        $sector->save();

        //information sur la saison
        $season = new Season();
        $season->seasontable_id = $sector->id;
        $season->seasontable_type = 'App\Sector';
        $season->summer = $request->input('summer');
        $season->autumn = $request->input('autumn');
        $season->winter = $request->input('winter');
        $season->spring = $request->input('spring');
        $season->save();

        //information sur l'orientation
        $orientation = new Orientation();
        $orientation->orientable_id = $sector->id;
        $orientation->orientable_type = 'App\Sector';
        $orientation->north = $request->input('north');
        $orientation->east = $request->input('east');
        $orientation->south = $request->input('south');
        $orientation->west = $request->input('west');
        $orientation->north_east = $request->input('north_east');
        $orientation->north_west = $request->input('north_west');
        $orientation->south_east = $request->input('south_east');
        $orientation->south_west = $request->input('south_west');
        $orientation->save();

        return response()->json(json_encode($sector));

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
            'lat' => 'required',
            'lng' => 'required',
            'label' => 'required|max:255'
        ]);

        //Modification du secteur
        $sector = Sector::where('id', $request->input('id'))->first();
        $sector->label = $request->input('label');
        $sector->approach = $request->input('approach');
        $sector->rain_id = $request->input('rain_id');
        $sector->sun_id = $request->input('sun_id');
        $sector->lat = $request->input('lat');
        $sector->lng = $request->input('lng');
        $sector->save();

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

        return response()->json(json_encode($sector));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sector = Sector::where('id', $id)->first();

        if($sector->user_id == Auth::id()){
            $sector->delete();
        }
    }
}
