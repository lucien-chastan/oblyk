<?php

namespace App\Http\Controllers\CRUD;

use App\GymAdministrator;
use App\GymRoom;
use App\GymSector;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GymSectorController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UNE ROOM
    function gymSectorModal(Request $request){

        $id = $request->input('id');
        if(isset($id)){
            $gymSector = GymSector::where('id', $id)->first();
            $room_id = $gymSector->room_id;
            $callback = 'reloadCurrentVue';
        }else{
            $gymSector = new GymSector();
            $gymSector->label = $request->input('label');
            $gymSector->ref = $request->input('ref');
            $gymSector->height = $request->input('height');
            $gymSector->description = $request->input('description');
            $room_id = $request->input('room_id');
            $callback = 'reloadCurrentVue';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/gym_sectors' : '/gym_sectors/' . $id;

        $data = [
            'dataModal' => [
                'gym_sector' => $gymSector,
                'gym_id' => $request->input('gym_id'),
                'room_id' => $room_id,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.gym-sector', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->checkIsAdmin(GymRoom::find($request->input('room_id'))->id);

        //validation du formulaire
        $this->validate($request, ['label' => 'String|max:255']);

        //information sur la falaise
        $gymSector = new GymSector();
        $gymSector->room_id = $request->input('room_id');
        $gymSector->label = $request->input('label');
        $gymSector->ref = $request->input('ref');
        $gymSector->height = $request->input('height');
        $gymSector->description = $request->input('description');
        $gymSector->save();

        return response()->json(json_encode($gymSector));
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
        $this->validate($request, ['label' => 'String|max:255',]);

        //mise à jour des données de la salle
        $gymSector = GymSector::where('id', $request->input('id'))->first();

        $this->checkIsAdmin(GymRoom::find($gymSector->room_id)->id);


        $gymSector->label = $request->input('label');
        $gymSector->ref = $request->input('ref');
        $gymSector->height = $request->input('height');
        $gymSector->description = $request->input('description');
        $gymSector->save();

        return response()->json(json_encode($gymSector));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        //mise à jour des données de la salle
        $gymSector = GymSector::find($id);

        $this->checkIsAdmin(GymRoom::find($gymSector->room_id)->id);

        $gymSector->delete();

        return response()->json(json_encode($gymSector));
    }

    /**
     * @param $gym_id
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    private function checkIsAdmin ($gym_id){
        $isAdministrator = GymAdministrator::where([['user_id', Auth::id()], ['gym_id',$gym_id]])->exists();
        if(!$isAdministrator) {
            return redirect()->route('index');
        }
        return true;
    }
}
