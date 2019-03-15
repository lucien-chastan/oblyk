<?php

namespace App\Http\Controllers\CRUD;

use App\GymAdministrator;
use App\GymRoom;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class RoomController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UNE ROOM
    function roomModal(Request $request)
    {
        $GymRoom = GymRoom::class;

        $id = $request->input('id');
        if (isset($id)) {
            $gymRoom = $GymRoom::where('id', $id)->first();
            $gym_id = $gymRoom->gym_id;
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        } else {
            $gymRoom = new GymRoom();
            $gymRoom->label = $request->input('label');
            $gymRoom->order = $request->input('order');
            $gymRoom->description = $request->input('description');
            $gymRoom->lat = $request->input('lat');
            $gymRoom->lng = $request->input('lng');
            $gymRoom->gym_grade_id = $request->input('gym_grade_id');
            $gym_id = $request->input('gym_id');
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST') ? '/rooms' : '/rooms/' . $id;

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


    function uploadSchemeModal(Request $request)
    {
        $GymRoom = GymRoom::class;

        $id_room = $request->input('room_id');
        $gymRoom = $GymRoom::find($id_room);

        $data = [
            'dataModal' => [
                'room_id' => $id_room,
                'gym_id' => $gymRoom->gym_id,
                'title' => $request->input('title'),
                'callback' => $request->input('callback') ?? 'reloadCurrentVue'
            ]
        ];

        return view('modal.room-scheme', $data);
    }

    //Upload du bandeau et du logo
    function uploadScheme(Request $request)
    {
        $GymRoom = GymRoom::class;

        //validation du formulaire
        $this->validate($request, ['id' => 'required|integer']);

        $gymRoom = $GymRoom::find($request->input('id'));

        if ($request->hasFile('file')) {

            try {
                //Image en 2000px
                $scheme = Image::make($request->file('file'))
                    ->resize(2000, 2000, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->encode('png', 85)
                    ->save(storage_path('app/public/gyms/schemes/scheme-' . $gymRoom->id . '.png'));

                // save dimension for ratio
                $gymRoom->scheme_height = $scheme->height();
                $gymRoom->scheme_width = $scheme->width();
                $gymRoom->save();

            } catch (Exception $e) {

                //s'il y a un problème on supprime les images potentiellement uploadé
                if (file_exists(storage_path('app/public/gyms/schemes/scheme-' . $gymRoom->id . '.png'))) unlink(storage_path('app/public/gyms/scheme/scheme-' . $gymRoom->id . '.png'));
                if (file_exists(storage_path('app/public/gyms/schemes/100/scheme-' . $gymRoom->id . '.png'))) unlink(storage_path('app/public/gyms/scheme/100/scheme-' . $gymRoom->id . '.png'));

            }
        }

        return response()->json(json_encode($gymRoom));
    }

    function customScheme(Request $request, $gym_id, $room_id){
        $GymRoom = GymRoom::class;

        $gymRoom = $GymRoom::where('id', $room_id)->first();
        $gym_id = $gymRoom->gym_id;
        $callback = $request->input('callback') ?? 'reloadCurrentVue';

        //définition du chemin de sauvgarde
        $outputRoute = route('saveCustomScheme', ['gym_id' => $gym_id, 'room_id' => $room_id]);

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

        return view('modal.gym-scheme', $data);
    }

    function publishModal(Request $request, $gym_id, $room_id){
        $GymRoom = GymRoom::class;

        $gymRoom = $GymRoom::where('id', $room_id)->first();
        $gym_id = $gymRoom->gym_id;
        $callback = $request->input('callback') ?? 'reloadCurrentVue';

        //définition du chemin de sauvgarde
        $outputRoute = route('publishRoom', ['gym_id' => $gym_id, 'room_id' => $room_id]);

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

        return view('modal.room-publish', $data);
    }

    function publishRoom(Request $request) {
        $GymRoom = GymRoom::class;

        $gymRoom = $GymRoom::where('id', $request->input('id'))->first();

        $this->checkIsAdmin($gymRoom->gym_id);

        if($gymRoom->isPublished()) {
            $gymRoom->unpublished();
        } else {
            $gymRoom->publish();
        }

        return response()->json(json_encode($gymRoom));
    }

    function saveCustomScheme(Request $request) {
        $GymRoom = GymRoom::class;

        //mise à jour des données de la salle
        $gymRoom = $GymRoom::where('id', $request->input('room_id'))->first();

        $this->checkIsAdmin($gymRoom->gym_id);

        $gymRoom->scheme_bg_color = $request->input('scheme_bg_color');
        $gymRoom->banner_color = $request->input('banner_color');
        $gymRoom->banner_bg_color = $request->input('banner_bg_color');
        $gymRoom->banner_opacity = $request->input('banner_opacity');
        $gymRoom->save();

        return response()->json(json_encode($gymRoom));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkIsAdmin($request->input('gym_id'));

        //validation du formulaire
        $this->validate($request, ['label' => 'String|max:255']);

        //information sur la falaise
        $gymRoom = new GymRoom();
        $gymRoom->gym_id = $request->input('gym_id');
        $gymRoom->label = $request->input('label');
        $gymRoom->order = $request->input('order');
        $gymRoom->description = $request->input('description');
        $gymRoom->lat = $request->input('lat');
        $gymRoom->lng = $request->input('lng');
        $gymRoom->preferred_type = $request->input('preferred_type');
        $gymRoom->gym_grade_id = $request->input('gym_grade_id');
        $gymRoom->save();

        return response()->json(json_encode($gymRoom));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $GymRoom = GymRoom::class;

        //validation du formulaire
        $this->validate($request, ['label' => 'String|max:255',]);

        //mise à jour des données de la salle
        $gymRoom = $GymRoom::where('id', $request->input('id'))->first();

        $this->checkIsAdmin($gymRoom->gym_id);

        $gymRoom->label = $request->input('label');
        $gymRoom->order = $request->input('order');
        $gymRoom->description = $request->input('description');
        $gymRoom->lat = $request->input('lat');
        $gymRoom->lng = $request->input('lng');
        $gymRoom->preferred_type = $request->input('preferred_type');
        $gymRoom->gym_grade_id = $request->input('gym_grade_id');
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
        $GymRoom = GymRoom::class;

        //mise à jour des données de la salle
        $gymRoom = $GymRoom::find($id);

        $this->checkIsAdmin($gymRoom->gym_id);

        $gymRoom->delete();

        return response()->json(json_encode($gymRoom));
    }

    /**
     * @param $gym_id
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    private function checkIsAdmin($gym_id)
    {
        $GymAdministrator = GymAdministrator::class;

        $isAdministrator = $GymAdministrator::where([['user_id', Auth::id()], ['gym_id', $gym_id]])->exists();
        if (!$isAdministrator) {
            return redirect()->route('index');
        }
        return true;
    }
}
