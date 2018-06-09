<?php

namespace App\Http\Controllers\CRUD;

use App\Gym;
use App\GymRoom;
use App\oldSearch;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Mockery\Exception;



class RoomController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UNE ROOM
    function roomModal(Request $request){

        $id = $request->input('id');
        if(isset($id)){
            $gymRoom = GymRoom::where('id', $id)->first();
            $gym_id = $gymRoom->gym_id;
            $callback = 'reloadCurrentVue';
        }else{
            $gymRoom = new GymRoom();
            $gymRoom->label = $request->input('label');
            $gymRoom->description = $request->input('description');
            $gymRoom->lat = $request->input('lat');
            $gymRoom->lng = $request->input('lng');
            $gym_id = $request->input('gym_id');
            $callback = 'reloadCurrentVue';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/rooms/' . $gym_id : '/rooms/' . $gym_id . '/' . $id;

        $data = [
            'dataModal' => [
                'gym_room' => $gymRoom,
                'gym_id' => $gym_id,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.room', $data);
    }


    function uploadSchemeModal (Request $request) {

        $id_room = $request->input('room_id');
        $roomGym = GymRoom::find($id_room);

        $data = [
            'dataModal' => [
                'room_id' => $id_room,
                'gym_id' => $roomGym->gym_id,
                'title' => $request->input('title'),
            ]
        ];

        return view('modal.room-scheme', $data);
    }

    //Upload du bandeau et du logo
    function uploadScheme (Request $request){

        //validation du formulaire
        $this->validate($request, ['id' => 'required|integer']);

        $gymRoom = GymRoom::find($request->input('id'));

        if ($request->hasFile('file')) {

            try {
                //Image en 2000px
                $scheme = Image::make($request->file('file'))
                    ->resize(2000, 2000, function ($constraint) {$constraint->aspectRatio();})
                    ->encode('png', 85)
                    ->save(storage_path('app/public/gyms/schemes/scheme-' . $gymRoom->id . '.png'));

                // save dimension for ratio
                $gymRoom->scheme_height = $scheme->height();
                $gymRoom->scheme_width = $scheme->width();
                $gymRoom->save();

                // 100*100 version
                $scheme->fit(100, 100)->save(storage_path('app/public/gyms/schemes/100/scheme-' . $gymRoom->id . '.png'));

            }catch (Exception $e){

                //s'il y a un problème on supprime les images potentiellement uploadé
                if(file_exists(storage_path('app/public/gyms/schemes/scheme-' . $gymRoom->id . '.png'))) unlink(storage_path('app/public/gyms/scheme/scheme-' . $gymRoom->id . '.png'));
                if(file_exists(storage_path('app/public/gyms/schemes/100/scheme-' . $gymRoom->id . '.png'))) unlink(storage_path('app/public/gyms/scheme/100/scheme-' . $gymRoom->id . '.png'));

            }
        }

        return response()->json(json_encode($gymRoom));
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
        $this->validate($request, ['label' => 'String|max:255']);

        //information sur la falaise
        $gymRoom = new GymRoom();
        $gymRoom->gym_id = $request->input('gym_id');
        $gymRoom->label = $request->input('label');
        $gymRoom->description = $request->input('description');
        $gymRoom->lat = $request->input('lat');
        $gymRoom->lng = $request->input('lng');
        $gymRoom->save();

        return response()->json(json_encode($gymRoom));
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
        $gymRoom = GymRoom::where('id', $request->input('id'))->first();

        $gymRoom->label = $request->input('label');
        $gymRoom->description = $request->input('description');
        $gymRoom->lat = $request->input('lat');
        $gymRoom->lng = $request->input('lng');
        $gymRoom->save();

        return response()->json(json_encode($gymRoom));
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
        $gymRoom = GymRoom::find($id)->delete();

        return response()->json(json_encode($gymRoom));
    }
}
