<?php

namespace App\Http\Controllers\CRUD;

use App\Orientation;
use App\Season;
use App\Sector;
use App\Route;
use App\RouteSection;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectorController extends Controller
{
    private $gradePattern = '/(([1-9][abc]?)|(B[0-9]|B1[0-6])|(E[0-9]|E1[0-1])|(PD|AD|D|TD|ED|ABO)|([I]{1,3}|IV|V[III]{0,3}|IX|X[III]{0,3})|(M|D|VD|S|HS|VS|HVS)|(VB|V[0-9]|V1[0-9]|V20)|(A[0-6])|(5\.[0-9]|5\.1[0-5][abcd]))/';
    private $subGradePattern = '/(\/\-|\/\+|\?|\+\/\?|\-\/\?|\+\/b|\+\/c|\+|\-)/';

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
    // Display modal for importing routes from CSV file
    function routecsvModal(Request $request)
    {
        if ($request->hasFile('file')) {
            $this->parseCsv($request);
        }
        $data = [
            'dataModal' => [
                'title' => $request->input('title'),
                'crag_id' => $request->input('crag_id'),
                'separator' => ",",
                'method' => 'POST',
                'route' => route('routecsvModal'),
                'callback' => 'reloadSector',
                'submit' => 'uploadCragCsv',
            ],
        ];
        return view('modal.routecsv', $data);
    }
    private function parseCsv(Request $request) {
        $filename = $request->file('file')->getRealPath();
        $handle = fopen($filename, "r");
        $all_data = array();
        $err = False;
        $err_msg = '';
        /*
         * row data order (or as in resources/lang/en/modals/route.php ):
            0 sector name
            1 route name
            2 type of route 
            3 grade (| separator )
            4 length 
            5 opener
            6 opening date
         */
        $climb_types = ['bouldering' => 2, 'sport climbing' => 3, 'multi pitch' => 4, 'trad climbing' => 5, 'aid climbing' => 6, 'deep water' => 7, 'via ferrata' => 8];

        while ( ($data = fgetcsv($handle, 0, $request->input('separator', ',')) ) !== FALSE ) {
            $data[3] = explode("|", $data[3]);
            if (!in_array($data[2], array_keys($climb_types))) {
                $err = True;
                $err_msg .= "Route ".$data[1]." has an unknown type (bouldering, multi pitch, etc.)";
            }
            $data[6] = ($data[6] != null) ? $data[6] : 0;
            $data[4] = ($data[4] != null) ? $data[4] : 0;

            array_push($all_data, $data);
        }

        // TODO i dont know how to properly display error msg returned by ajax request
        if ($err)
            abort(400, $err_msg);


        // populate DB
        foreach($all_data as $route_) {
            $sector = Sector::firstOrCreate([
                'label' => $route_[0], 
                'crag_id' => $request->input('crag_id')],
                [
                'user_id' => Auth::user()->id,
                'rain_id' => 1, // unknown
                'sun_id' => 1, //unknown
                'lat' => 0, //unknown
                'lng' => 0, //unknown
                ]);

            $route = Route::firstOrCreate([
                'label' => $route_[1],
                'crag_id' => $request->input('crag_id'),
                'sector_id' => $sector->id,
            ], [
                'user_id' => Auth::user()->id,
                'opener' => $route_[5],
                'open_year' => $route_[6],
                'note' => 0,
                'nb_note' => 0,
                'nb_longueur' => count($route_[3]),
                'height' => $route_[4],
                'climb_id'=> $climb_types[$route_[2]],

            ]);
            $idx = 1;
            if (count($route_[3]) > 1 && $route->wasRecentlyCreated) {
                foreach($route_[3] as $pitch) {
                    $myLongueur = new RouteSection();
                    $myLongueur->route_id = $route->id;
                    $myLongueur->grade = preg_replace($this->subGradePattern, '', $pitch);
                    $myLongueur->sub_grade = preg_replace($this->gradePattern, '', $pitch);
                    $myLongueur->grade_val = Route::gradeToVal($myLongueur->grade, $myLongueur->sub_grade);
                    $myLongueur->section_order = $idx++;
                    $myLongueur->reception_id = 1;
                    $myLongueur->start_id = 1;
                    $myLongueur->point_id = 1;
                    $myLongueur->anchor_id = 1;
                    $myLongueur->incline_id = 1;
                    $myLongueur->save();
                }
            }

        }
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
