<?php

namespace App\Http\Controllers\CRUD;

use App\GymAdministrator;
use App\GymRoom;
use App\GymRoute;
use App\GymSector;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GymRouteController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UNE ROOM
    function gymRouteModal(Request $request)
    {
        $GymRoute = GymRoute::class;
        $GymSector = GymSector::class;

        $sector = $GymSector::find($request->input('sector_id'));

        $id = $request->input('id');
        if (isset($id)) {
            $gymRoute = $GymRoute::where('id', $id)->first();
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        } else {
            $gymRoute = new GymRoute();
            $gymRoute->label = $request->input('label');
            $gymRoute->sector_id = $request->input('sector_id');
            $gymRoute->ref = $request->input('ref');
            $gymRoute->height = $request->input('height') ?? $sector->height;
            $gymRoute->description = $request->input('description');
            $gymRoute->sector_id = $request->input('sector_id') ?? $sector->id;
            $gymRoute->type = $request->input('type') ?? $sector->preferred_type;
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST') ? '/gym_routes' : '/gym_routes/' . $id;

        $data = [
            'dataModal' => [
                'gym_route' => $gymRoute,
                'room_id' => $sector->room_id,
                'gym_id' => $request->input('gym_id'),
                'sector_id' => $request->input('sector_id'),
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.gym-route', $data);
    }

    function uploadRoutePictureModal(Request $request, $gym_id, $route_id)
    {
        $GymRoute = GymRoute::class;

        $gymRoute = $GymRoute::find($route_id);

        $data = [
            'dataModal' => [
                'route_id' => $gymRoute->id,
                'gym_id' => $gym_id,
                'title' => $request->input('title'),
                'callback' => $request->input('callback') ?? 'reloadCurrentVue'
            ]
        ];

        return view('modal.room-route', $data);
    }

    function uploadRoutePicture(Request $request) {
        $GymRoute = GymRoute::class;

        //validation du formulaire
        $this->validate($request, ['id' => 'required|integer']);

        $gymRoute = $GymRoute::find($request->input('id'));

        if ($request->hasFile('file')) {

            try {
                //Image en 2000px
                $scheme = Image::make($request->file('file'))
                    ->resize(1300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->encode('jpg', 85)
                    ->save(storage_path('app/public/gyms/routes/1300/route-' . $gymRoute->id . '.jpg'));

                // 100*100 version
                $scheme->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/gyms/routes/500/route-' . $gymRoute->id . '.jpg'));

                $scheme->fit(200, 200)->save(storage_path('app/public/gyms/routes/200/route-' . $gymRoute->id . '.jpg'));
                $scheme->fit(50, 50)->save(storage_path('app/public/gyms/routes/50/route-' . $gymRoute->id . '.jpg'));

            } catch (Exception $e) {

                //s'il y a un problème on supprime les images potentiellement uploadé
                if (file_exists(storage_path('app/public/gyms/routes/1300/route-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/1300/route-' . $gymRoute->id . '.jpg'));
                if (file_exists(storage_path('app/public/gyms/routes/500/route-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/500/route-' . $gymRoute->id . '.jpg'));
                if (file_exists(storage_path('app/public/gyms/routes/200/route-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/200/route-' . $gymRoute->id . '.jpg'));
                if (file_exists(storage_path('app/public/gyms/routes/50/route-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/50/route-' . $gymRoute->id . '.jpg'));

            }
        }

        return response()->json(json_encode($gymRoute));
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
        $gymRoute = new GymRoute();
        $gymRoute->sector_id = $request->input('sector_id');
        $gymRoute->label = $request->input('label');
        $gymRoute->reference = $request->input('reference');
        $gymRoute->height = $request->input('height');
        $gymRoute->description = $request->input('description');
        $gymRoute->sector_id = $request->input('sector_id');
        $gymRoute->type = $request->input('type');
        $gymRoute->save();

        return response()->json(json_encode($gymRoute));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $GymRoute = GymRoute::class;
        $GymRoom = GymRoom::class;

        //validation du formulaire
        $this->validate($request, ['label' => 'String|max:255',]);

        //mise à jour des données de la salle
        $gymRoute = $GymRoute::where('id', $request->input('id'))->first();

        $this->checkIsAdmin($GymRoom::find($gymRoute->room_id)->id);

        $gymRoute->label = $request->input('label');
        $gymRoute->ref = $request->input('ref');
        $gymRoute->height = $request->input('height');
        $gymRoute->description = $request->input('description');
        $gymRoute->sector_id = $request->input('sector_id');
        $gymRoute->type = $request->input('type');
        $gymRoute->save();

        return response()->json(json_encode($gymRoute));
    }


    public function saveSchemeArea($gym_id, $sector_id, Request $request)
    {
        $GymRoute = GymRoute::class;

        $sector = $GymRoute::find($sector_id);
        $sector->area = $request->input('area');
        $sector->save();
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
        $GymRoute = GymRoute::class;
        $GymRoom = GymRoom::class;

        //mise à jour des données de la salle
        $gymRoute = $GymRoute::find($id);

        $this->checkIsAdmin($GymRoom::find($gymRoute->room_id)->id);

        $gymRoute->delete();

        return response()->json(json_encode($gymRoute));
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
