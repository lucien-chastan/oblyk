<?php

namespace App\Http\Controllers\CRUD;

use App\GymAdministrator;
use App\GymRoom;
use App\GymSector;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GymSectorController extends Controller
{

    // Display Create / Update modal
    function gymSectorModal(Request $request)
    {
        $GymSector = GymSector::class;
        $GymRoom = GymRoom::class;

        $room = $GymRoom::find($request->input('room_id'));

        $id = $request->input('id');
        if (isset($id)) {
            $gymSector = $GymSector::where('id', $id)->first();
            $room_id = $gymSector->room_id;
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        } else {
            $gymSector = new GymSector();
            $gymSector->label = $request->input('label');
            $gymSector->group_sector = $request->input('group_sector');
            $gymSector->height = $request->input('height');
            $gymSector->description = $request->input('description');
            $gymSector->preferred_type = $request->input('preferred_type') ?? $room->preferred_type;
            $gymSector->gym_grade_id = $room->gym_grade_id;
            $room_id = $request->input('room_id');
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        }

        // Output method
        $outputRoute = ($request->input('method') == 'POST') ? '/gym_sectors' : '/gym_sectors/' . $id;

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

    function uploadSectorPictureModal(Request $request, $gym_id, $sector_id)
    {
        $GymSector = GymSector::class;

        $gymSector = $GymSector::find($sector_id);

        $data = [
            'dataModal' => [
                'sector_id' => $gymSector->id,
                'gym_id' => $gym_id,
                'title' => $request->input('title'),
                'callback' => $request->input('callback') ?? 'reloadCurrentVue'
            ]
        ];

        return view('modal.room-sector', $data);
    }

    function uploadSectorPicture(Request $request)
    {
        $GymSector = GymSector::class;

        $this->validate($request, ['id' => 'required|integer']);

        $gymSector = $GymSector::find($request->input('id'));

        if ($request->hasFile('file')) {

            try {
                // 2000px version
                $scheme = Image::make($request->file('file'))
                    ->resize(1300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->encode('jpg', 85)
                    ->save(storage_path('app/public/gyms/sectors/1300/sector-' . $gymSector->id . '.jpg'));

                // 100px * 100px version
                $scheme->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/gyms/sectors/500/sector-' . $gymSector->id . '.jpg'));

                $scheme->fit(200, 200)->save(storage_path('app/public/gyms/sectors/200/sector-' . $gymSector->id . '.jpg'));
                $scheme->fit(50, 50)->save(storage_path('app/public/gyms/sectors/50/sector-' . $gymSector->id . '.jpg'));

            } catch (\Exception $e) {

                // If there is a problem, we delete the downloaded images
                if (file_exists(storage_path('app/public/gyms/sectors/1300/sector-' . $gymSector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/1300/sector-' . $gymSector->id . '.jpg'));
                if (file_exists(storage_path('app/public/gyms/sectors/500/sector-' . $gymSector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/500/sector-' . $gymSector->id . '.jpg'));
                if (file_exists(storage_path('app/public/gyms/sectors/200/sector-' . $gymSector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/200/sector-' . $gymSector->id . '.jpg'));
                if (file_exists(storage_path('app/public/gyms/sectors/50/sector-' . $gymSector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/50/sector-' . $gymSector->id . '.jpg'));

            }
        }

        return response()->json(json_encode($gymSector));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $GymRoom = GymRoom::class;

        $this->checkIsAdmin($GymRoom::find($request->input('room_id'))->id);

        // Valid form
        $this->validate($request, ['label' => 'String|max:255']);

        $gymSector = new GymSector();
        $gymSector->room_id = $request->input('room_id');
        $gymSector->label = $request->input('label');
        $gymSector->group_sector = $request->input('group_sector');
        $gymSector->height = $request->input('height');
        $gymSector->description = $request->input('description');
        $gymSector->preferred_type = $request->input('preferred_type');
        $gymSector->gym_grade_id = $request->input('gym_grade_id');
        $gymSector->save();

        return response()->json(json_encode($gymSector));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $GymSector = GymSector::class;
        $GymRoom = GymRoom::class;

        // Valid form
        $this->validate($request, ['label' => 'String|max:255',]);

        $gymSector = $GymSector::where('id', $request->input('id'))->first();

        $this->checkIsAdmin($GymRoom::find($gymSector->room_id)->id);

        $gymSector->label = $request->input('label');
        $gymSector->group_sector = $request->input('group_sector');
        $gymSector->height = $request->input('height');
        $gymSector->description = $request->input('description');
        $gymSector->preferred_type = $request->input('preferred_type');
        $gymSector->gym_grade_id = $request->input('gym_grade_id');
        $gymSector->save();

        return response()->json(json_encode($gymSector));
    }


    public function saveSchemeArea($gym_id, $sector_id, Request $request)
    {
        $GymSector = GymSector::class;

        $sector = $GymSector::find($sector_id);
        $sector->area = $request->input('area');
        $sector->save();
    }

    public function deleteSchemeArea($gym_id, $sector_id, Request $request)
    {
        $GymSector = GymSector::class;

        $sector = $GymSector::find($sector_id);
        $sector->area = null;
        $sector->save();
    }

    public function deletePhoto($sector_id)
    {
        $sector = GymSector::where('id', $sector_id)->with('room')->first();
        $this->checkIsAdmin($sector->room->gym_id);

        echo 'test ' . $sector->id;

        if (file_exists(storage_path('app/public/gyms/sectors/1300/sector-' . $sector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/1300/sector-' . $sector->id . '.jpg'));
        if (file_exists(storage_path('app/public/gyms/sectors/500/sector-' . $sector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/500/sector-' . $sector->id . '.jpg'));
        if (file_exists(storage_path('app/public/gyms/sectors/200/sector-' . $sector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/200/sector-' . $sector->id . '.jpg'));
        if (file_exists(storage_path('app/public/gyms/sectors/50/sector-' . $sector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/50/sector-' . $sector->id . '.jpg'));
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
        $GymSector = GymSector::class;
        $GymRoom = GymRoom::class;

        $gymSector = $GymSector::find($id);

        $this->checkIsAdmin($GymRoom::find($gymSector->room_id)->id);

        $gymSector->delete();

        return response()->json(json_encode($gymSector));
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
