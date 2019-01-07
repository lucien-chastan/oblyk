<?php

namespace App\Http\Controllers\CRUD;

use App\GymAdministrator;
use App\GymGrade;
use App\Route;
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
    private $gradePattern = '/(([1-9][abc]?)|(B[0-9]|B1[0-6])|(E[0-9]|E1[0-1])|(PD|AD|D|TD|ED|ABO)|([I]{1,3}|IV|V[III]{0,3}|IX|X[III]{0,3})|(M|D|VD|S|HS|VS|HVS)|(VB|V[0-9]|V1[0-9]|V20)|(A[0-6])|(5\.[0-9]|5\.1[0-5][abcd]))/';
    private $subGradePattern = '/(\/\-|\/\+|\?|\+\/\?|\-\/\?|\+\/b|\+\/c|\+|\-)/';

    // Display modal for add or edit gym route
    function gymRouteModal(Request $request)
    {
        $GymRoute = GymRoute::class;
        $GymSector = GymSector::class;
        $GymRoom = GymRoom::class;
        $GymGrade = GymGrade::class;

        $sector = $GymSector::find($request->input('sector_id'));
        $room = $GymRoom::find($sector->room_id);
        $gradeSystem = $GymGrade::where('id', $sector->gym_grade_id ?? $room->gym_grade_id)->with('gradeLines')->first();

        $id = $request->input('id');
        if (isset($id)) {
            $gymRoute = $GymRoute::where('id', $id)->first();
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
            $colors = $gymRoute->colors();
            $estimateGradeLevel = $gymRoute->estimateGradeLevel($gradeSystem->id);
        } else {
            $gymRoute = new GymRoute();
            $gymRoute->label = $request->input('label');
            $gymRoute->sector_id = $request->input('sector_id');
            $gymRoute->ref = $request->input('ref');
            $gymRoute->height = $request->input('height') ?? $sector->height;
            $gymRoute->description = $request->input('description');
            $gymRoute->sector_id = $request->input('sector_id') ?? $sector->id;
            $gymRoute->type = $request->input('type') ?? $sector->preferred_type;
            $gymRoute->opener_date = new \DateTime();
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
            $colors = $gradeSystem->gradeLines[0]->colors();
            $gymRoute->grade = Route::valToGrad($gradeSystem->gradeLines[0]->grade_val, true);
            $estimateGradeLevel = $gradeSystem->gradeLines[0]->id;
        }

        $secondColor = (count($colors) > 1);

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
                'room' => $room,
                'sector' => $sector,
                'callback' => $callback,
                'colors' => $colors,
                'use_second_color' => $secondColor,
                'estimateGradeLevel' => $estimateGradeLevel
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

    function uploadRouteThumbnailModal(Request $request, $gym_id, $route_id)
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

        return view('modal.room-route-thumbnail', $data);
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

    function uploadRouteThumbnail(Request $request) {
        $GymRoute = GymRoute::class;

        //validation du formulaire
        $this->validate($request, ['id' => 'required|integer']);

        $gymRoute = $GymRoute::find($request->input('id'));

        if ($request->hasFile('file')) {

            try {
                Image::make($request->file('file'))
                    ->fit(50, 50)
                    ->save(storage_path('app/public/gyms/routes/100/thumbnail-' . $gymRoute->id . '.jpg'));

            } catch (Exception $e) {

                //s'il y a un problème on supprime les images potentiellement uploadé
                if (file_exists(storage_path('app/public/gyms/routes/100/thumbnail-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/100/thumbnail-' . $gymRoute->id . '.jpg'));

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

        // Valid form
        $this->validate($request,
            [
                'opener_date' => 'required',
                'grade' => [
                    'required',
                    'regex:/^((([1-9][abc]?)|(B[0-9]|B1[0-6])|(E[0-9]|E1[0-1])|(PD|AD|D|TD|ED|ABO)|([I]{1,3}|IV|V[III]{0,3}|IX|X[III]{0,3})|(M|D|VD|S|HS|VS|HVS)|(VB|V[0-9]|V1[0-9]|V20)|(A[0-6])|(5\.[0-9]|5\.1[0-5][abcd]))(\+|\-|\/\-|\/\+|\?|\+\/\?|\-\/\?|\+\/b|\+\/c)?|\?)$/'
                ]
            ]
        );

        // Extract grade and sub grade from grade
        $grade = $request->input('grade');
        $routeGrade = preg_replace($this->subGradePattern, '', $grade);
        $routeSubGrade = preg_replace($this->gradePattern, '', $grade);

        // Concat colors
        $colors[] = $request->input('color_first');
        if ($request->input('use_second_color')) {
            $colors[] = $request->input('color_second');
        }

        // Create and save new route
        $gymRoute = new GymRoute();
        $gymRoute->sector_id = $request->input('sector_id');
        $gymRoute->reference = $request->input('reference');
        $gymRoute->label = $request->input('label');
        $gymRoute->grade = $routeGrade;
        $gymRoute->sub_grade = $routeSubGrade;
        $gymRoute->val_grade = Route::gradeToVal($routeGrade, $routeSubGrade);
        $gymRoute->description = $request->input('description');
        $gymRoute->type = $request->input('type');
        $gymRoute->height = $request->input('height');
        $gymRoute->opener = $request->input('opener');
        $gymRoute->opener_date = $request->input('opener_date');
        $gymRoute->color = join(';', $colors);
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
        $this->checkIsAdmin($request->input('gym_id'));
        $GymRoute = GymRoute::class;

        // Valid form
        $this->validate($request,
            [
                'opener_date' => 'required',
                'grade' => [
                    'required',
                    'regex:/^((([1-9][abc]?)|(B[0-9]|B1[0-6])|(E[0-9]|E1[0-1])|(PD|AD|D|TD|ED|ABO)|([I]{1,3}|IV|V[III]{0,3}|IX|X[III]{0,3})|(M|D|VD|S|HS|VS|HVS)|(VB|V[0-9]|V1[0-9]|V20)|(A[0-6])|(5\.[0-9]|5\.1[0-5][abcd]))(\+|\-|\/\-|\/\+|\?|\+\/\?|\-\/\?|\+\/b|\+\/c)?|\?)$/'
                ]
            ]
        );

        // Extract grade and sub grade from grade
        $grade = $request->input('grade');
        $routeGrade = preg_replace($this->subGradePattern, '', $grade);
        $routeSubGrade = preg_replace($this->gradePattern, '', $grade);

        // Concat colors
        $colors[] = $request->input('color_first');
        if ($request->input('use_second_color')) {
            $colors[] = $request->input('color_second');
        }

        // Create and save new route
        $gymRoute = $GymRoute::find($request->input('id'));
        $gymRoute->sector_id = $request->input('sector_id');
        $gymRoute->reference = $request->input('reference');
        $gymRoute->label = $request->input('label');
        $gymRoute->grade = $routeGrade;
        $gymRoute->sub_grade = $routeSubGrade;
        $gymRoute->val_grade = Route::gradeToVal($routeGrade, $routeSubGrade);
        $gymRoute->description = $request->input('description');
        $gymRoute->type = $request->input('type');
        $gymRoute->height = $request->input('height');
        $gymRoute->opener = $request->input('opener');
        $gymRoute->opener_date = $request->input('opener_date');
        $gymRoute->color = join(';', $colors);
        $gymRoute->save();

        return response()->json(json_encode($gymRoute));
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
     * @param $route_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function dismountRoute($route_id)
    {
        $GymRoute = GymRoute::class;

        $gymRoute = $GymRoute::where('id', $route_id)->with('sector.room')->first();

        $this->checkIsAdmin($gymRoute->sector->room->gym_id);

        if ($gymRoute->dismounted_at == null) {
            $gymRoute->dismounted_at = new \DateTime();
        } else {
            $gymRoute->dismounted_at = null;
        }
        $gymRoute->save();

        return response()->json(json_encode($gymRoute));
    }

    /**
     * @param $route_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function favoriteRoute($route_id)
    {
        $GymRoute = GymRoute::class;

        $gymRoute = $GymRoute::where('id', $route_id)->with('sector.room')->first();

        $this->checkIsAdmin($gymRoute->sector->room->gym_id);

        $gymRoute->favorite = !$gymRoute->favorite;
        $gymRoute->save();

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
